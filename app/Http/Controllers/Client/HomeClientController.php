<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeClientController extends Controller
{
    /**
     * Mostrar listado de productos (home del cliente)
     */
    public function products(Request $request)
    {
        // Solo permitir acceso a usuarios con rol "client"
        if (auth()->user()->role !== 'client') {
            // Redirige al dashboard si no es cliente
            return redirect('/dashboard');
        }

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

    /**
     * Mostrar detalle de un producto
     */
    public function show($id)
    {
        // Solo permitir acceso a usuarios con rol "client"
        if (auth()->user()->role !== 'client') {
            // Redirige al dashboard si no es cliente
            return redirect('/dashboard');
        }

        // Cargar relaciones necesarias: category, reviews.user, user (vendor)
        $product = Product::with(['category', 'reviews.user', 'user'])->findOrFail($id);

        // Retornar la vista de detalle con la variable $product
        return view('client_products.show', compact('product'));
    }
}
