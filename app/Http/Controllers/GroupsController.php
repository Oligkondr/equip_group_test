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

        $pathList = array_filter(explode('/', $path));

        $groups = Group::query()
            ->with('childrenRecursive')
            ->where('id_parent', 0)
            ->get();

        $query = Product::query()->with('price');

        if ($pathList) {
            $current = Group::find(last($pathList));
            $childrenIds = $current->getChildrenIds();

            $query->whereIn('id_group', $childrenIds);
        }

        switch ($order) {
            case 'price_asc':
                $query->select('products.*')
                    ->join('prices', 'products.id', '=', 'prices.id_product')
                    ->orderBy('price');
                break;
            case 'price_desc':
                $query->select('products.*')
                    ->join('prices', 'products.id', '=', 'prices.id_product')
                    ->orderByDesc('price');
                break;
            case 'name_asc':
                $query->orderBy('name');
                break;
            case 'name_desc':
                $query->orderByDesc('name');
                break;
        }

        $products = $query->paginate($size)->withQueryString();

        return view('groups.list', [
            'path' => $path,
            'pathList' => $pathList,
            'groups' => $groups,
            'products' => $products,
            'order' => $order,
            'size' => $size,
        ]);
    }
}
