<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeClientController extends Controller
{
    public function products()
    {
        // Solo traes los productos, ordenados del más nuevo al más antiguo
        $products = Product::latest()->get();

        // Envía los productos a la vista 'client_products/products.blade.php'
        return view('client_products.products', compact('products'));
    }
}
