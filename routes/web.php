<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Client\HomeClientController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterEntrepreneurController;

// Ruta de bienvenida
Route::get('/', function () {
    return view('landing');
});

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    // Añadir dentro del grupo de rutas protegidas o fuera según tu necesidad
    Route::get('/deliveries', function () {
    // la vista está en resources/views/deliveries/deliveries.blade.php
    return view('deliveries.deliveries');
    })->name('deliveries');

    // RUTA SOLO PARA EMPRENDEDORES
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD de productos - SOLO EMPRENDEDORES
    Route::resource('products', ProductController::class);

    // Módulo de ventas SOLO EMPRENDEDORES
    Route::resource('ventas', VentasController::class);

    // CRUD de emprendedores (si lo usas solo interno)
    Route::resource('entrepreneurs', EntrepreneurController::class);

    // RUTA SOLO PARA CLIENTES
    Route::get('/clients/products', [HomeClientController::class, 'products'])->name('clients.products');

    // CRUD de clientes (si lo usas solo interno)
    Route::resource('clients', ClientController::class);

    // CRUD de categorías (si aplica para ambos, valida dentro de cada método)
    Route::resource('categories', CategoryController::class);

    // CHAT - RUTA COMPARTIDA
    Route::get('/chat', [ChatController::class, 'index'])->name('chats.index');

    // Reseñas (si aplica solo para clientes, protege en el controlador)
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Otros módulos compartidos o específicos...
    Route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos.index');

    // PERFIL COMBINADO (vista nueva, no reemplaza la /profile existente)
    // Mostrar la vista combinada (GET)
    Route::get('/profile/combined', [ProfileController::class, 'showProfile'])
        ->name('profile.combined.show');

    // Ruta de compatibilidad con nombre antiguo si alguna vista usaba underscore.
    // Esta ruta apunta a un path distinto para evitar colisiones, y evita el error
    // "Route [profile_combined.show] not defined" mientras actualizas vistas.
    Route::get('/profile_combined', [ProfileController::class, 'showProfile'])
        ->name('profile_combined.show');

    // Guardar/actualizar sección "Perfil" (tabla entrepreneurs) (POST)
    Route::post('/profile/combined/update-profile', [ProfileController::class, 'updateProfile'])
        ->name('profile.combined.updateProfile');

    // Guardar/actualizar sección "Emprendimiento" (tabla entrepreneurships) (POST)
    Route::post('/profile/combined/update-business', [ProfileController::class, 'updateBusiness'])
        ->name('profile.combined.updateBusiness');

    //
    // Rutas de compatibilidad (por si algunas vistas/partials usan los nombres antiguos)
    // Estas rutas evitan errores "Route [profile.updateProfile] not defined" mientras migras nombres.
    //
    Route::post('/profile/update-profile', [ProfileController::class, 'updateProfile'])
        ->name('profile.updateProfile');

    Route::post('/profile/update-business', [ProfileController::class, 'updateBusiness'])
        ->name('profile.updateBusiness');

    // Alias para mostrar el perfil (compatibilidad)
    Route::get('/profile/show', [ProfileController::class, 'showProfile'])
        ->name('profile.show');

    // PERFIL (Breeze) - mantengo las rutas originales de Breeze para editar el User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // RUTA AGREGADA: Eliminar cuenta sin contraseña (para Facebook y usuarios sin password)
    Route::delete('/profile/delete', [ProfileController::class, 'destroyAccount'])->name('profile.delete');

    // Módulo de costos (puedes proteger dentro de los métodos)

    // Añadida ruta para compras (evita error de ruta no definida)
    Route::get('/compras', [ComprasController::class, 'index'])->name('compras.index');

    // Más rutas protegidas aquí...
});

// Breeze auth
require __DIR__.'/auth.php';

// Rutas para autenticación externa (si usas social login)
Route::get('/auth/redirect', [AuthController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/callback', [AuthController::class, 'callback'])->name('auth.callback');

// --------- RUTA PARA REGISTRO DE EMPRENDEDOR --------------
// Esta ruta debe aceptar tanto GET como POST para recibir datos de la vista anterior y mostrarlos en la vista de emprendimiento
// Muestra la vista de emprendimiento (POST y GET)
Route::match(['get', 'post'], '/register/entrepreneur', function (Request $request) {
    // SOLO muestra la vista, NO valida nada aquí
    return view('auth.register_entrepreneur', [
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => $request->input('password'),
        'password_confirmation' => $request->input('password_confirmation'),
    ]);
})->name('register.entrepreneur');

// Procesa el registro de emprendimiento
Route::post('/register/entrepreneur/post', [RegisterEntrepreneurController::class, 'store'])->name('register.entrepreneur.post');