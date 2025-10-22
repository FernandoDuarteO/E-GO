<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CostosController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Client\HomeClientController;
use App\Http\Controllers\ComprasController; // AGREGA ESTE IMPORTANTE IMPORT
use App\Http\Controllers\AuthController;

// Ruta de bienvenida
Route::get('/', function () {
    return view('landing');
});

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {

    // RUTA SOLO PARA EMPRENDEDORES
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // En el DashboardController, valida manualmente que solo el emprendedor acceda

    // CRUD de productos - SOLO EMPRENDEDORES
    Route::resource('/products', ProductController::class);
    // En ProductController, valida cada método para que solo el emprendedor pueda crear/editar/eliminar productos

    // Módulo de ventas SOLO EMPRENDEDORES
    Route::resource('ventas', VentasController::class);
    // ...otras rutas de ventas aquí, todas protegidas en el controlador

    // CRUD de emprendedores (si lo usas solo interno)
    Route::resource('/entrepreneurs', EntrepreneurController::class);

    // RUTA SOLO PARA CLIENTES
    Route::get('/clients/products', [HomeClientController::class, 'products'])->name('clients.products');
    // En el HomeClientController valida que solo el cliente acceda

    // CRUD de clientes (si lo usas solo interno)
    Route::resource('/clients', ClientController::class);

    // CRUD de categorías (si aplica para ambos, valida dentro de cada método)
    Route::resource('/categories', CategoryController::class);

    // CHAT - RUTA COMPARTIDA
    Route::get('/chat', [ChatController::class, 'index'])->name('chats.index');
    // Puedes dejar el acceso a ambos y manejar lógica interna para separar mensajes

    // Reseñas (si aplica solo para clientes, protege en el controlador)
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Otros módulos compartidos o específicos...
    Route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos.index');

    // PERFIL (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Módulo de costos (puedes proteger dentro de los métodos)
    Route::prefix('costos')->group(function () {
        Route::get('/', [CostosController::class, 'index'])->name('costos.index');
        Route::get('/estructura', [CostosController::class, 'getEstructura'])->name('costos.estructura');
        Route::post('/estructura', [CostosController::class, 'guardarEstructura'])->name('costos.guardar');
        Route::delete('/estructura/{id}', [CostosController::class, 'eliminarItem'])->name('costos.eliminar');
        Route::post('/calcular', [CostosController::class, 'calcularCostoUnitario'])->name('costos.calcular');
        Route::post('/pronostico', [CostosController::class, 'getPronostico'])->name('costos.pronostico');
        Route::get('/rentabilidad', [CostosController::class, 'analizarRentabilidad'])->name('costos.rentabilidad');
    });

    // AGREGA ESTA RUTA PARA QUE NO TENGAS EL ERROR DE RUTA NO DEFINIDA
    Route::get('/compras', [ComprasController::class, 'index'])->name('compras.index');
    // Si después tienes más métodos REST de compras, puedes agregar el resource:
    // Route::resource('compras', ComprasController::class);

    // Más rutas aquí...
});

// Breeze auth
require __DIR__.'/auth.php';

// Rutas para autenticación externa (si usas social login)
Route::get('/auth/redirect', [AuthController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/callback', [AuthController::class, 'callback'])->name('auth.callback');
