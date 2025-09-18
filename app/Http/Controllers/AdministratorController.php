<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Http\Requests\AdministratorRequest;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $administrators = Administrator::latest()->paginate(5);
        return view('administrators.index', compact('administrators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $administrators = new Administrator();
        return view('administrators.create', compact('administrators'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdministratorRequest $request)
    {
        Administrator::create($request->validated());
        return redirect()->route('administrators.index')->with('success', 'Administrador creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $administrators = Administrator::find($id);
        return view('administrators.show', compact('administrators'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $administrators = Administrator::find($id);
        return view('administrators.edit', compact('administrators'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdministratorRequest $request, int $id)
    {
        $administrators = Administrator::find($id);
        $administrators->update($request->validated());

        return redirect()->route('administrators.index')->with('updated', 'Administrador actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $administrators = Administrator::find($id);
        $administrators->delete();

        return redirect()->route('administrators.index')->with('deleted', 'Administrador eliminado correctamente');
    }
}
