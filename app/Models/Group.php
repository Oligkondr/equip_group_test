<?php

namespace App\Models;

use Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    public $timestamps = false;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'id_group');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'id_parent');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Group::class, 'id_parent');
    }

    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }

    public function getChildrenIds(): array
    {
        return Cache::remember("group:{$this->id}:children_ids", 60 * 30, function () {
            $result = [$this->id];
            $children = $this->childrenRecursive->toArray();

            return array_merge($result, $this->arrayPluckRecursive($children));
        });
    }

    public function getPath()
    {
        return Cache::remember("group:{$this->id}:get_path", 60 * 30, function () {
            $result = [];

            $current = $this;

            do {
                $result[] = $current->id;
                $current = $current->parent;
            } while ($current);

            return implode('/', array_reverse($result));
        });
    }

    private function arrayPluckRecursive(array $array): array
    {
        $results = [];

        foreach ($array as $item) {
            $results[] = $item['id'];

            if ($item['children_recursive']) {
                $results = array_merge($results, $this->arrayPluckRecursive($item['children_recursive']));
            }
        }

        return $results;
    }
}
