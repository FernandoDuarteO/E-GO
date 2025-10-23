<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Redirige a Facebook con el rol guardado en sesión
    public function redirect(Request $request)
    {
        $role = $request->query('role', 'client'); // Por defecto "client"
        session(['facebook_role' => $role]);
        Log::info('Socialite redirect role:', ['role' => $role]);
        return Socialite::driver('facebook')->redirect();
    }

    // Callback que recibe Facebook
    public function callback(Request $request)
    {
        $facebookUser = Socialite::driver('facebook')->stateless()->user();
        $role = session('facebook_role', 'client');
        Log::info('Socialite callback role:', ['role' => $role]);

        $user = User::firstOrCreate(
            ['email' => $facebookUser->getEmail()],
            [
                'name' => $facebookUser->getName(),
                'role' => $role,
            ]
        );

        // Validación: si el usuario existe pero con otro rol
        if ($user->role !== $role) {
            Auth::logout();
            session()->forget('facebook_role');
            return redirect()->route('login')->withErrors([
                'email' => 'Este correo ya está registrado como ' . ($user->role === 'client' ? 'cliente' : 'emprendedor') . '.',
            ]);
        }

        Auth::login($user);
        session()->forget('facebook_role');

        // Redirección según el rol
        if ($user->role === 'entrepreneur') {
            return redirect('/dashboard');
        } else {
            return redirect('/clients/products');
        }
    }
}
