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
     *
     * Comportamiento:
     * - La página de productos es pública (pueden verla usuarios no autenticados).
     * - Si el usuario está autenticado y su rol NO es "client", lo redirigimos al dashboard.
     * - Permite filtrar por category_id y por texto (q).
     * - Usa eager loading de relaciones relevantes y paginado.
     */
    public function products(Request $request)
    {
        // Si hay usuario autenticado, validar su rol (si no es cliente lo redirigimos)
        if (auth()->check() && auth()->user()->role !== 'client') {
            return redirect('/dashboard');
        }

        // Todas las categorías (para filtro UI)
        $categories = Category::all();

        // Parámetros de filtro
        $selectedCategory = $request->get('category_id');
        $q = $request->get('q');

        // Query base con eager loading para evitar N+1
        // usamos nombres de relación que suelen existir en el modelo: productImages, images, category, user, reviews
        $query = Product::query()
            ->with(['productImages', 'images', 'category', 'user', 'reviews']);

        // Filtro por categoría (si aplica)
        if ($selectedCategory) {
            $query->where('category_id', $selectedCategory);
        }

        // Búsqueda por texto (nombre o descripción)
        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', '%' . $q . '%')
                    ->orWhere('description', 'like', '%' . $q . '%');
            });
        }

        // Orden y paginado
        $products = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();

        return view('client_products.products', compact('products', 'categories', 'selectedCategory'));
    }

    /**
     * Mostrar detalle de un producto
     *
     * - Si el usuario autenticado existe y no es cliente, lo redirige al dashboard.
     * - Si la petición es AJAX (o viene ?ajax=1) devuelve SOLO el fragmento modal (vista show).
     * - Si la petición NO es AJAX (acceso directo a /clients/products/{id}) redirige a la lista
     *   con ?open={id} para que la vista products abra el modal encima de la lista.
     */
    public function show(Request $request, $id)
    {
        // Si hay usuario autenticado, validar su rol
        if (auth()->check() && auth()->user()->role !== 'client') {
            return redirect('/dashboard');
        }

        // Cargar el producto con relaciones necesarias
        $product = Product::with([
            'productImages',
            'images',
            'category',
            'user',
            'reviews.user'
        ])->findOrFail($id);

        // Si la petición viene por AJAX (fetch desde products) devolvemos solo el fragmento
        if ($request->ajax() || $request->query('ajax')) {
            return view('client_products.show', compact('product'));
        }

        // Petición directa en navegador: redirigir a la lista y pedir que abra el modal
        // La vista products debe detectar ?open={id} y llamar a la función que inyecta/abre el modal.
        return redirect()->route('clients.products', ['open' => $id]);
    }
}