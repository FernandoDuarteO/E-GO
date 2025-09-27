<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Chat;
use App\Http\Requests\ChatRequest;

use App\Models\Entrepreneur;
use App\Models\Client;


class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chats = Chat::with('entrepreneur','client')->paginate(5);
        return view('chats.index', compact('chats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $chats = new Chat();
        $entrepreneurs = Entrepreneur::all();
        $clients = Client::all();
        return view('chats.create', compact('chats', 'entrepreneurs', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChatRequest $request)
    {
        Chat::create($request->validated());
        return redirect()->route('chats.index')->with('success', 'Chat creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $chats = Chat::find($id);
        $entrepreneurs = Entrepreneur::all();
        $clients = Client::all();
        return view('chats.show', compact('chats', 'entrepreneurs', 'clients'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $chats = Chat::find($id);
        $entrepreneurs = Entrepreneur::all();
        $clients = Client::all();
        return view('chats.edit', compact('chats', 'entrepreneurs', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChatRequest $request, int $id)
    {
        $chats = Chat::find($id);
        $chats->update($request->validated());
        return redirect()->route('chats.index')->with('updated', 'Chat actualizado con éxito.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $chats = Chat::find($id);
        $chats->delete();
        return redirect()->route('chats.index')->with('deleted', 'Chat eliminado con éxito.');
}
