<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\PedidosController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Productos
Route::get('/productos', function () {
    return view('productos.index');
})->name('productos.index');

Route::get('/productos/create', function () {
    return view('productos.create');
})->name('productos.create');

Route::get('/productos/{id}/edit', function ($id) {
    return view('productos.edit', ['id' => $id]);
})->name('productos.edit');

Route::get('/productos/{id}', function ($id) {
    return view('productos.show', ['id' => $id]);
})->name('productos.show');

// Otros módulos
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
Route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos.index');
