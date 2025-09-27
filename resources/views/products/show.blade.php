@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Detalle del producto</h2>
    <div class="card p-4 shadow" style="border-radius: 16px;">
        <div class="row align-items-center">
            <!-- Imagen del producto -->
            <div class="col-md-5 text-center mb-4 mb-md-0">
                @if($products->media_file)
                    <img src="{{ asset('storage/' . $products->media_file) }}"
                         alt="Foto del producto"
                         style="width: 100%; max-width: 320px; aspect-ratio: 1/1; object-fit: cover; border-radius: 16px; box-shadow: 0 4px 24px rgba(80,80,150,0.10);">
                @else
                    <img src="https://via.placeholder.com/320?text=Sin+Imagen"
                         alt="Sin foto"
                         style="width: 100%; max-width: 320px; aspect-ratio: 1/1; object-fit: cover; border-radius: 16px;">
                @endif
            </div>
            <!-- Info del producto -->
            <div class="col-md-7">
                <ul class="list-unstyled fs-5">
                    <li><strong>Nombre:</strong> {{ $products->name }}</li>
                    <li><strong>Cantidad:</strong> {{ $products->quantity }}</li>
                    <li><strong>Precio:</strong> ${{ number_format($products->price, 2) }}</li>
                    <li class="mb-3"><strong>Descripción:</strong> {{ $products->description }}</li>
                </ul>
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary me-2">Volver</a>
                    <a href="{{ route('products.edit', $products->id) }}" class="btn btn-warning">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection