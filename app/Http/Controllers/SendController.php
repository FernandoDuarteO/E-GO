<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Send;
use App\Http\Requests\SendRequest;

use App\Models\Product;
use App\Models\Delivery;

class SendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sends = Send::with('product', 'delivery')->paginate(5);
        return view('sends.index', compact('sends'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sends = new Send();
        $products = Product::all();
        $deliveries = Delivery::all();
        return view('sends.create', compact('sends', 'products', 'deliveries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SendRequest $request)
    {
        Send::create($request->validated());
        return redirect()->route('sends.index')->with('success', 'Envío creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $sends = Send::find($id);
        $products = Product::all();
        $deliveries = Delivery::all();
        return view('sends.show', compact('sends', 'products', 'deliveries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $sends = Send::find($id);
        $products = Product::all();
        $deliveries = Delivery::all();
        return view('sends.edit', compact('sends', 'products', 'deliveries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SendRequest $request, int $id)
    {
        $sends = Send::find($id);
        $sends->update($request->validated());
        return redirect()->route('sends.index')->with('updated', 'Envío actualizado con éxito.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $sends = Send::find($id);
        $sends->delete();
        return redirect()->route('sends.index')->with('deleted', 'Envío eliminado con éxito.');
    }
}
