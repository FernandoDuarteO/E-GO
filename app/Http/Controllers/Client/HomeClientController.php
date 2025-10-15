<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeClientController extends Controller
{
    public function products(Request $request)
    {
        // Obtén todas las categorías
        $categories = Category::all();

        // Verifica si hay categoría seleccionada
        $selectedCategory = $request->get('category_id');

        // Filtra productos por categoría si corresponde, sino muestra todos
        $products = Product::when($selectedCategory, function ($query) use ($selectedCategory) {
            return $query->where('category_id', $selectedCategory);
        })->latest()->get();

        // Envía productos, categorías y categoría seleccionada a la vista
        return view('client_products.products', compact('products', 'categories', 'selectedCategory'));
    }
}
