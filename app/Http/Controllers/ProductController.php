<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function __invoke(Product $product)
    {
        $product->load('price');

        return view('product', [
            'product' => $product,
        ]);
    }
}
