<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::latest()->paginate(5);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = new Client();
        return view('clients.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        Client::create($request->validated());
        return redirect()->route('clients.index')->with('success', 'Cliente creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $clients = Client::find($id);
        return view('clients.show', compact('clients'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $clients = Client::find($id);
        return view('clients.edit', compact('clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, int $id)
    {
        $clients = Client::find($id);
        $clients->update($request->validated());

        return redirect()->route('clients.index')->with('updated', 'Cliente actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $clients = Client::find($id);
        $clients->delete();

        return redirect()->route('clients.index')->with('deleted', 'Cliente eliminado correctamente');
    }
}
