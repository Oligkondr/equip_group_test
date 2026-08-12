<?php

namespace App\Http\Controllers;

use App\Models\Group;

class GroupsController extends Controller
{
    public function __invoke(string $path = null)
    {
        $path = array_filter(explode('/', $path));

        $groups = Group::query()
            ->with('childrenRecursive')
            ->where('id_parent', 0)
            ->get();

        return view('groups', [
            'path' => $path,
            'groups' => $groups,
        ]);
    }
}
