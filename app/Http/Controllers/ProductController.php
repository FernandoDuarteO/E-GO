<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

use App\Models\Entrepreneurship;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('entrepreneurship', 'category')->paginate(5);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = new Product();
        $entrepreneurships = Entrepreneurship::all();
        $categories = Category::all();
        return view('products.create', compact('products', 'entrepreneurships', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('products.index')->with('success', 'Producto creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $products = Product::find($id);
        $entrepreneurships = Entrepreneurship::all();
        $categories = Category::all();
        return view('products.show', compact('products', 'entrepreneurships', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $products = Product::find($id);
        $entrepreneurships = Entrepreneurship::all();
        $categories = Category::all();
        return view('products.edit', compact('products', 'entrepreneurships', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, int $id)
    {
        $products = Product::find($id);
        $products->update($request->validated());
        return redirect()->route('products.index')->with('updated', 'Producto actualizado con éxito.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $products = Product::find($id);
        $products->delete();
        return redirect()->route('products.index')->with('deleted', 'Producto eliminado con éxito.');
    }
}
