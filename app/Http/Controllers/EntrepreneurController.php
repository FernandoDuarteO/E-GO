<?php

namespace App\Http\Controllers;

use App\Models\Entrepreneur;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EntrepreneurRequest;

class EntrepreneurController extends Controller
{
    // Mostrar el perfil del usuario autenticado
    public function index()
    {
        $entrepreneur = Entrepreneur::where('user_id', Auth::id())->first();
        return view('entrepreneurs.index', compact('entrepreneur'));
    }

    // Formulario para crear el perfil (solo si no existe)
    public function create()
    {
        $entrepreneur = Entrepreneur::where('user_id', Auth::id())->first();
        if ($entrepreneur) {
            return redirect()->route('entrepreneurs.index')->with('error', 'Ya tienes un perfil creado.');
        }
        return view('entrepreneurs.create');
    }

    // Guardar nuevo perfil (solo si no existe)
    public function store(EntrepreneurRequest $request)
    {
        $entrepreneur = Entrepreneur::where('user_id', Auth::id())->first();
        if ($entrepreneur) {
            return redirect()->route('entrepreneurs.index')->with('error', 'Ya tienes un perfil creado.');
        }

        $data = $request->validated();
        $data['user_id'] = Auth::id();

        // Manejo de imagen
        if ($request->hasFile('media_file')) {
            $file = $request->file('media_file');
            $path = $file->store('entrepreneurs', 'public');
            $data['media_file'] = $path;
        }

        Entrepreneur::create($data);

        return redirect()->route('entrepreneurs.index')->with('success', 'Perfil creado correctamente.');
    }

    // Mostrar el perfil específico (solo el del usuario autenticado)
    public function show()
    {
        $entrepreneur = Entrepreneur::where('user_id', Auth::id())->firstOrFail();
        return view('entrepreneurs.show', compact('entrepreneur'));
    }

    // Formulario para editar el perfil (solo el del usuario autenticado)
    public function edit()
    {
        $entrepreneur = Entrepreneur::where('user_id', Auth::id())->firstOrFail();
        return view('entrepreneurs.edit', compact('entrepreneur'));
    }

    // Actualizar el perfil (solo el del usuario autenticado)
    public function update(EntrepreneurRequest $request)
    {
        $entrepreneur = Entrepreneur::where('user_id', Auth::id())->firstOrFail();
        $data = $request->validated();

        // Manejo de imagen
        if ($request->hasFile('media_file')) {
            $file = $request->file('media_file');
            $path = $file->store('entrepreneurs', 'public');
            $data['media_file'] = $path;
        }

        $entrepreneur->update($data);

        return redirect()->route('entrepreneurs.index')->with('success', 'Perfil actualizado correctamente.');
    }

    // Eliminar el perfil (solo el del usuario autenticado)
    public function destroy()
    {
        $entrepreneur = Entrepreneur::where('user_id', Auth::id())->firstOrFail();

        if ($entrepreneur->media_file) {
            \Storage::disk('public')->delete($entrepreneur->media_file);
        }

        $entrepreneur->delete();

        return redirect()->route('entrepreneurs.index')->with('success', 'Perfil eliminado correctamente. Ahora puedes crear uno nuevo.');
    }
}
