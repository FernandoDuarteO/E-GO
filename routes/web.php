<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Client\HomeClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;

use App\Http\Controllers\ChatController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

// Ruta de bienvenida
Route::get('/', function () {
    return view('auth.register');
});

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // ...otras rutas...
});

    // Productos (CRUD)
    Route::resource('products', ProductController::class);
    // Perfil (CRUD)
    Route::resource('entrepreneurs', EntrepreneurController::class);
    // Home Cliente
    Route::get('/clients/products', [HomeClientController::class, 'products'])->name('clients.products');

    // Perfil Cliente
    Route::resource('clients', ClientController::class);
    // Categorías (CRUD)
    Route::resource('categories', CategoryController::class);

    // Reseñas
    Route::post('/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');

    // Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chats.index');

    // Otros módulos
    Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
    Route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos.index');

    // Rutas de perfil (manteniendo las de Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación Breeze
require __DIR__.'/auth.php';

Route::get('/auth/redirect', [AuthController::class, 'redirect'])
    ->name('auth.redirect');

Route::get('/auth/callback', [AuthController::class, 'callback'])
    ->name('auth.callback');
