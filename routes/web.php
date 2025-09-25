<?php

use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\PedidosController;

Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
Route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos.index');

Route::get('/', function () {
    return redirect()->route('productos.index');
    return redirect()->route('chat.index');
    return redirect()->route('ventas.index');
    return redirect()->route('pedidos.index');
});
