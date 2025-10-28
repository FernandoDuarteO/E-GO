<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Entrepreneurship;

class RegisterEntrepreneurController extends Controller
{
    /**
     * Procesa el registro de emprendedor.
     */
    public function store(Request $request)
    {
        // Validar los campos
        $validated = $request->validate([
            'business_name'      => 'required|string|max:255',
            'department'         => 'required|string|max:255',
            'years_experience'   => 'required|integer|min:0',
            'description'        => 'required|string|max:1000',
            'business_type'      => 'required|string|max:255',
            'name'               => 'required|string|max:255',
            'email'              => 'required|string|email|max:255|unique:users',
            'password'           => 'required|string|min:8|confirmed',
        ]);

        // Crear el usuario
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'entrepreneur',
        ]);

        // Crear el emprendimiento
        Entrepreneurship::create([
            'user_id'           => $user->id,
            'business_name'     => $validated['business_name'],
            'department'        => $validated['department'],
            'years_experience'  => $validated['years_experience'],
            'description'       => $validated['description'],
            'business_type'     => $validated['business_type'],
        ]);

        // Iniciar sesión automáticamente
        Auth::login($user);

        // Redirigir al dashboard
        return redirect()->route('dashboard')->with('success', '¡Registro exitoso como emprendedor!');
    }
}
