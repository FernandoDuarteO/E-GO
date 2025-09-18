<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;
use App\Http\Requests\RegisterRequest;

use App\Models\Client;
use App\Models\Administrator;
use App\Models\Entrepreneur;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registers = Register::with('client', 'administrator', 'entrepreneur')->paginate(5);
        return view('registers.index', compact('registers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $registers = new Register();
        $clients = Client::all();
        $administrators = Administrator::all();
        $entrepreneurs = Entrepreneur::all();
        return view('registers.create', compact('registers', 'clients', 'administrators', 'entrepreneurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        Register::create($request->validated());
        return redirect()->route('registers.index')->with('success', 'Registro creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $registers = Register::find($id);
        $clients = Client::all();
        $administrators = Administrator::all();
        $entrepreneurs = Entrepreneur::all();
        return view('registers.show', compact('registers', 'clients', 'administrators', 'entrepreneurs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $registers = Register::find($id);
        $clients = Client::all();
        $administrators = Administrator::all();
        $entrepreneurs = Entrepreneur::all();
        return view('registers.edit', compact('registers', 'clients', 'administrators', 'entrepreneurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegisterRequest $request, int $id)
    {
        $registers = Register::find($id);
        $registers->update($request->validated());
        return redirect()->route('registers.index')->with('updated', 'Registro actualizado con éxito.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $registers = Register::find($id);
        $registers->delete();
        return redirect()->route('registers.index')->with('deleted', 'Registro eliminado con éxito.');
    }
}
