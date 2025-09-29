<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        $user = User::firstOrCreate([
            'email' => $user->getEmail()
        ], [
            'name' => $user->getName()
        ]);

        Auth::login($user);

        return redirect()->to('/dashboard');
    }
}