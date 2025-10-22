<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Redirige a Facebook con el rol guardado en sesión
    public function redirect(Request $request)
    {
        // Toma el rol desde query string (?role=client o ?role=entrepreneur)
        $role = $request->query('role', 'client'); // Por defecto "client"
        session(['facebook_role' => $role]);
        return Socialite::driver('facebook')->redirect();
    }

    // Callback que recibe Facebook
public function callback(Request $request)
{
    $facebookUser = Socialite::driver('facebook')->stateless()->user();

    $role = session('facebook_role', 'client');

    $user = User::firstOrCreate(
        ['email' => $facebookUser->getEmail()],
        [
            'name' => $facebookUser->getName(),
            'role' => $role,
        ]
    );

    // --- AQUÍ va la validación ---
    if ($user->role !== $role) {
        Auth::logout();
        return redirect()->route('login')->withErrors([
            'email' => 'Este correo ya está registrado como ' . ($user->role === 'client' ? 'cliente' : 'emprendedor') . '.',
        ]);
    }

    Auth::login($user);

    // Redirección según el rol
    if ($user->role === 'entrepreneur') {
        return redirect('/dashboard');
    } else {
        return redirect('/clients/products');
    }
}
}
