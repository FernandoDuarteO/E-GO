<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\ClientController;

use App\Http\Controllers\ChatController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CostosController;
use App\Http\Controllers\AuthController;

// Ruta de bienvenida
Route::get('/', function () {
    return view('auth.register');
});

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Productos (CRUD)
    Route::resource('products', ProductController::class);
    // Emprendedores (CRUD)
    Route::resource('entrepreneurs', EntrepreneurController::class);
    // Clientes (CRUD)
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

    // Perfil (rutas Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 📦 Módulo de Costos
    Route::prefix('costos')->group(function () {
        Route::get('/', [CostosController::class, 'index'])->name('costos.index');

        // Estructura de costos
        Route::get('/estructura', [CostosController::class, 'getEstructura'])->name('costos.estructura');
        Route::post('/estructura', [CostosController::class, 'guardarEstructura'])->name('costos.guardar');
        Route::delete('/estructura/{id}', [CostosController::class, 'eliminarItem'])->name('costos.eliminar');

        // Cálculos y análisis
        Route::post('/calcular', [CostosController::class, 'calcularCostoUnitario'])->name('costos.calcular');
        Route::get('/pronostico', [CostosController::class, 'getPronostico'])->name('costos.pronostico');
        Route::get('/rentabilidad', [CostosController::class, 'analizarRentabilidad'])->name('costos.rentabilidad');
        
    });
});

// Autenticación (Breeze)
require __DIR__.'/auth.php';

// Rutas para autenticación externa
Route::get('/auth/redirect', [AuthController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/callback', [AuthController::class, 'callback'])->name('auth.callback');