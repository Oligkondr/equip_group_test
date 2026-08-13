<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function __invoke(Product $product)
    {
        $product->load(['price', 'group']);

        return view('product.item', [
            'product' => $product,
        ]);
    }
}
