@extends('layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Detalle del producto #{{ $id }}</h2>

<div class="card shadow-sm">
    <img src="{{ asset('assets/images/producto 2.webp') }}" class="card-img-top" alt="Producto">
    <div class="card-body">
        <h5 class="card-title">Aretes</h5>
        <p class="fw-bold">C$50.00</p>
        <span class="badge bg-danger">Agotado</span>
        <p class="mt-3">Descripción de ejemplo del producto...</p>
    </div>
</div>

<a href="{{ route('productos.index') }}" class="btn btn-secondary mt-3">Volver</a>
@endsection

