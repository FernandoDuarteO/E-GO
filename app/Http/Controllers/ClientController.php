<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
    // Mostrar el perfil del usuario autenticado
    public function index()
    {
        $client = Client::where('user_id', Auth::id())->first();
        return view('clients.index', compact('client'));
    }

    // Formulario para crear el perfil (solo si no existe)
    public function create()
    {
        $client = Client::where('user_id', Auth::id())->first();
        if ($client) {
            return redirect()->route('clients.index')->with('error', 'Ya tienes un perfil creado.');
        }
        return view('clients.create');
    }

    // Guardar nuevo perfil (solo si no existe)
    public function store(ClientRequest $request)
    {
        $client = Client::where('user_id', Auth::id())->first();
        if ($client) {
            return redirect()->route('clients.index')->with('error', 'Ya tienes un perfil creado.');
        }

        $data = $request->validated();
        $data['user_id'] = Auth::id();

        // Manejo de imagen
        if ($request->hasFile('media_file')) {
            $file = $request->file('media_file');
            $path = $file->store('clients', 'public');
            $data['media_file'] = $path;
        }

        Client::create($data);

        return redirect()->route('clients.index')->with('success', 'Perfil de cliente creado correctamente.');
    }

    // Mostrar el perfil específico (solo el del usuario autenticado)
    public function show()
    {
        $client = Client::where('user_id', Auth::id())->firstOrFail();
        return view('clients.show', compact('client'));
    }

    // Formulario para editar el perfil (solo el del usuario autenticado)
    public function edit()
    {
        $client = Client::where('user_id', Auth::id())->firstOrFail();
        return view('clients.edit', compact('client'));
    }

    // Actualizar el perfil (solo el del usuario autenticado)
    public function update(ClientRequest $request)
    {
        $client = Client::where('user_id', Auth::id())->firstOrFail();
        $data = $request->validated();

        // Manejo de imagen
        if ($request->hasFile('media_file')) {
            $file = $request->file('media_file');
            $path = $file->store('clients', 'public');
            $data['media_file'] = $path;
        }

        $client->update($data);

        return redirect()->route('clients.index')->with('success', 'Perfil de cliente actualizado correctamente.');
    }

    // Eliminar el perfil (solo el del usuario autenticado)
    public function destroy()
    {
        $client = Client::where('user_id', Auth::id())->firstOrFail();

        if ($client->media_file) {
            \Storage::disk('public')->delete($client->media_file);
        }

        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Perfil de cliente eliminado correctamente. Ahora puedes crear uno nuevo.');
    }
}
