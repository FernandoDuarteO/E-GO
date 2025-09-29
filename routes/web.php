<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\PedidosController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Productos (usando el resource controller si quieres CRUD completo)
Route::resource('products', ProductController::class);

// Chat
Route::get('/chat', [ChatController::class, 'index'])->name('chats.index');

// Otros módulos
Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
Route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos.index');