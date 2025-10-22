<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Muestra la vista de login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Maneja una solicitud de autenticación entrante.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentica al usuario
        $request->authenticate();

        // Regenera la sesión para evitar fijación de sesión
        $request->session()->regenerate();

        // Validar el rol seleccionado en el formulario
        $selectedRole = $request->input('role');
        $user = Auth::user();

        if ($user->role !== $selectedRole) {
            Auth::logout();
            return back()->withInput($request->only('email'))->withErrors([
                'email' => 'No tienes permisos para acceder como ' . ($selectedRole === 'client' ? 'cliente' : 'emprendedor') . '.',
            ]);
        }

        // Redirección personalizada según el rol
        if ($user->role === 'entrepreneur') {
            return redirect('/dashboard');
        } else {
            return redirect('/clients/products');
        }
    }

    /**
     * Cierra la sesión autenticada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
