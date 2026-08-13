<?php

namespace Tests\Unit;

use App\Models\Group;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_children_ids_includes_self_and_all_descendants(): void
    {
        $ids = Group::find(1)->getChildrenIds();

        sort($ids);
        $this->assertSame([1, 4, 5, 11, 12, 13, 14, 15, 24, 25, 26, 27, 28, 29, 30, 31], $ids);
    }

    public function test_get_children_ids_for_leaf_group_returns_only_self(): void
    {
        $this->assertSame([19], Group::find(19)->getChildrenIds());
    }

    public function test_get_children_ids_result_is_cached(): void
    {
        Cache::flush();

        $group = Group::find(1);

        $this->assertFalse(Cache::has('group:1:children_ids'));

        $group->getChildrenIds();

        $this->assertTrue(Cache::has('group:1:children_ids'));
        $this->assertSame($group->getChildrenIds(), Cache::get('group:1:children_ids'));
    }

    public function test_get_parents_returns_ancestors_root_first_including_self(): void
    {
        $parents = Group::find(24)->getParents();

        $this->assertSame([1, 4, 12, 24], $parents->pluck('id')->all());
    }

    public function test_get_parents_for_root_group_returns_only_self(): void
    {
        $parents = Group::find(1)->getParents();

        $this->assertSame([1], $parents->pluck('id')->all());
    }

    public function test_get_path_returns_imploded_ancestor_ids(): void
    {
        $this->assertSame('1/4/12/24', Group::find(24)->getPath());
        $this->assertSame('1/4/11', Group::find(11)->getPath());
    }

    public function test_get_path_for_root_group_returns_own_id(): void
    {
        $this->assertSame('1', Group::find(1)->getPath());
    }

    public function test_get_count_counts_products_in_whole_subtree(): void
    {
        $this->assertSame(41, Group::find(1)->getCount());
        $this->assertSame(7, Group::find(12)->getCount());
        $this->assertSame(4, Group::find(11)->getCount());
    }

    public function test_get_count_for_leaf_group(): void
    {
        $this->assertSame(8, Group::find(19)->getCount());
    }

    public function test_get_count_matches_manual_subtree_query(): void
    {
        $group = Group::find(1);
        $expected = Product::whereIn('id_group', $group->getChildrenIds())->count();

        $this->assertSame($expected, $group->getCount());
    }
}
