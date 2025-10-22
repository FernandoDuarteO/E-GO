<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role !== 'entrepreneur') {
            abort(403); // O puedes redirigir a donde quieras
            // return redirect('/clients/products');
        }
        return view('dashboard.index'); // Vista solo para emprendedor
    }
}
