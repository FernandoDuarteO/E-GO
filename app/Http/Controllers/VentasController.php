<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VentasController extends Controller
{
    public function index()
    {
        return view('ventas.index');
    }

    public function create()
    {
        return view('ventas.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Aquí iría la lógica para guardar la venta
        // Por ahora solo redirigimos al index
        return redirect()->route('ventas.index')
                         ->with('success', 'Venta registrada exitosamente');
    }
}
