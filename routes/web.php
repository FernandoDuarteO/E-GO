<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\VentasController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Client\HomeClientController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterEntrepreneurController;
use App\Http\Controllers\Client\CartController;

/*
|--------------------------------------------------------------------------
| Public routes (accessible without authentication)
|--------------------------------------------------------------------------
|
| Routes that must be reachable by guests (e.g. product listing and product
| detail used by the "eye" quick-view and by users not logged in).
|
*/

// Landing page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Public: listado de productos para clientes (vista pública)
Route::get('/clients/products', [HomeClientController::class, 'products'])
    ->name('clients.products');

// Public: detalle de producto para clientes (también usado por AJAX ?ajax=1)
// Nombre correcto: clients.products.show (coincide con route('clients.products.show', $product))
Route::get('/clients/products/{product}', [HomeClientController::class, 'show'])
    ->name('clients.products.show');

// Carrito (público — soporta invitados vía session y usuarios autenticados vía BD)
// index (ver carrito), store (agregar), update (cantidad), destroy (eliminar), clear (vaciar)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

/*
|--------------------------------------------------------------------------
| Authenticated routes
|--------------------------------------------------------------------------
|
| Rutas que requieren autenticación (y verificación si corresponde).
|
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Deliveries view (protected)
    Route::get('/deliveries', function () {
        return view('deliveries.deliveries');
    })->name('deliveries');

    // Dashboard for entrepreneurs
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD de productos - SOLO EMPRENDEDORES
    Route::resource('products', ProductController::class);

    // Módulo de ventas - SOLO EMPRENDEDORES
    Route::resource('ventas', VentasController::class);

    // CRUD de emprendedores (interno)
    Route::resource('entrepreneurs', EntrepreneurController::class);

    // CRUD de clientes (interno)
    Route::resource('clients', ClientController::class);

    // CRUD de categorías
    Route::resource('categories', CategoryController::class);

    // Chat (compartido)

    // Reseñas: almacenar (protegido — el controlador debe validar que sea cliente)
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Pedidos
    Route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos.index');

    // Perfil combinado (GET/POST handlers)
    Route::redirect('/perfil', '/profile/combined', 302);
    Route::get('/profile/combined', [ProfileController::class, 'showProfile'])->name('profile.combined.show');

    // Backwards-compatible alias
    Route::get('/profile_combined', [ProfileController::class, 'showProfile'])->name('profile_combined.show');

    // Update profile / business (POST)
    Route::post('/profile/combined/update-profile', [ProfileController::class, 'updateProfile'])
        ->name('profile.combined.updateProfile');

    Route::post('/profile/combined/update-business', [ProfileController::class, 'updateBusiness'])
        ->name('profile.combined.updateBusiness');

    // Compatibility aliases (legacy names)
    Route::post('/profile/update-profile', [ProfileController::class, 'updateProfile'])
        ->name('profile.updateProfile');

    Route::post('/profile/update-business', [ProfileController::class, 'updateBusiness'])
        ->name('profile.updateBusiness');

    // Alias to show profile
    Route::get('/profile/show', [ProfileController::class, 'showProfile'])->name('profile.show');

    // Breeze profile routes (edit/update/destroy)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Delete account (compatibility)
    Route::delete('/profile/delete', [ProfileController::class, 'destroyAccount'])->name('profile.delete');

    // Compras

    // Más rutas protegidas...
});

/*
|--------------------------------------------------------------------------
| Auth & misc public routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

// Social auth (si usado)
Route::get('/auth/redirect', [AuthController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/callback', [AuthController::class, 'callback'])->name('auth.callback');

// Registro emprendedor (GET/POST)
Route::match(['get', 'post'], '/register/entrepreneur', function (Request $request) {
    return view('auth.register_entrepreneur', [
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => $request->input('password'),
        'password_confirmation' => $request->input('password_confirmation'),
    ]);
})->name('register.entrepreneur');

Route::post('/register/entrepreneur/post', [RegisterEntrepreneurController::class, 'store'])
    ->name('register.entrepreneur.post');