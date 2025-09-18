<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Http\Requests\DeliveryRequest;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = Delivery::latest()->paginate(5);
        return view('deliveries.index', compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $deliveries = new Delivery();
        return view('deliveries.create', compact('deliveries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveryRequest $request)
    {
        Delivery::create($request->validated());
        return redirect()->route('deliveries.index')->with('success', 'Delivery creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $deliveries = Delivery::find($id);
        return view('deliveries.show', compact('deliveries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $deliveries = Delivery::find($id);
        return view('deliveries.edit', compact('deliveries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeliveryRequest $request, int $id)
    {
        $deliveries = Delivery::find($id);
        $deliveries->update($request->validated());

        return redirect()->route('deliveries.index')->with('updated', 'Delivery actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $deliveries = Delivery::find($id);
        $deliveries->delete();

        return redirect()->route('deliveries.index')->with('deleted', 'Delivery eliminado correctamente');
    }
}
