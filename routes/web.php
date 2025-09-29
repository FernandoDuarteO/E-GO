<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\PedidosController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


// Otros módulos
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
Route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos.index');
