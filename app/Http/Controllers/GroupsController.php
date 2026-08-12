<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Product;

class GroupsController extends Controller
{
    public function __invoke(string $path = null)
    {
        $order = request('order');
        $size = request('size', 6);

        $path = array_filter(explode('/', $path));

        $groups = Group::query()
            ->with('childrenRecursive')
            ->where('id_parent', 0)
            ->get();

        $query = Product::query();

        if ($path) {
            $current = Group::find(last($path));
            $childrenIds = $current->getChildrenIds();

            $query->whereIn('id_group', $childrenIds);
        }

        $products = $query->paginate($size);

        return view('groups', [
            'path' => $path,
            'groups' => $groups,
            'products' => $products,
        ]);
    }
}
