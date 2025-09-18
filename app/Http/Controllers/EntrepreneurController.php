<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrepreneur;
use App\Http\Requests\EntrepreneurRequest;

class EntrepreneurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entrepreneurs = Entrepreneur::latest()->paginate(5);
        return view('entrepreneurs.index', compact('entrepreneurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $entrepreneurs = new Entrepreneur();
        return view('entrepreneurs.create', compact('entrepreneurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntrepreneurRequest $request)
    {
        Entrepreneur::create($request->validated());
        return redirect()->route('entrepreneurs.index')->with('success', 'Emprendedor creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $entrepreneurs = Entrepreneur::find($id);
        return view('entrepreneurs.show', compact('entrepreneurs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $entrepreneurs = Entrepreneur::find($id);
        return view('entrepreneurs.edit', compact('entrepreneurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EntrepreneurRequest $request, int $id)
    {
        $entrepreneurs = Entrepreneur::find($id);
        $entrepreneurs->update($request->validated());

        return redirect()->route('entrepreneurs.index')->with('updated', 'Emprendedor actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $entrepreneurs = Entrepreneur::find($id);
        $entrepreneurs->delete();

        return redirect()->route('entrepreneurs.index')->with('deleted', 'Emprendedor eliminado correctamente');
    }
}
