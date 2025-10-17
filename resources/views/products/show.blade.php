@extends('layouts.app')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <li><strong>Precio:</strong> C${{ number_format($products->price, 2) }}</li>
                    <li class="mb-3"><strong>Descripción:</strong> {{ $products->description }}</li>
                </ul>
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary me-2">Volver</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Sección de reseñas de clientes --}}
    <div class="card mt-4 p-4 shadow-sm" style="border-radius: 16px;">
        <h4 class="mb-3">Reseñas de clientes</h4>
        @forelse($products->reviews as $review)
            <div class="mb-3 p-3 border rounded" style="background: #f9f9fd;">
                <strong>{{ $review->user->name }}</strong>
                <span>
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa {{ $i <= $review->rating ? 'fa-star text-warning' : 'fa-star text-secondary' }}"></i>
                    @endfor
                </span>
                <p class="mb-1">{{ $review->comment }}</p>
                <small>{{ $review->created_at->format('d/m/Y H:i') }}</small>
            </div>
        @empty
            <p class="text-muted">No hay reseñas para este producto todavía.</p>
        @endforelse
    </div>
</div>
@endsection
