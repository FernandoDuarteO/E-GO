@extends('layouts.app')

@section('content')
<<<<<<< HEAD
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="container py-4">
=======

<div class="container py-4 product-show-container">
>>>>>>> 2a85cbb8af80dadefb014f935c0d6ef87796995c
    <h2 class="mb-4">Detalle del producto</h2>

    <div class="card product-detail-card">
        <div class="row align-items-center">
            <!-- Imagen del producto -->
            <div class="col-md-5 text-center mb-4 mb-md-0 product-image-wrap">
                @if($products->media_file)
                    <img src="{{ asset('storage/' . $products->media_file) }}"
                         alt="Foto del producto"
                         class="product-image">
                @else
                    <img src="https://via.placeholder.com/320?text=Sin+Imagen"
                         alt="Sin foto"
                         class="product-image">
                @endif
            </div>

            <!-- Info del producto -->
            <div class="col-md-7">
                <ul class="list-unstyled product-info-list">
                    <li><strong>Nombre:</strong> {{ $products->name }}</li>
                    <li><strong>Cantidad:</strong> {{ $products->quantity }}</li>
                    <li><strong>Precio:</strong> C${{ number_format($products->price, 2) }}</li>
                    <li class="mb-3"><strong>Descripción:</strong> {{ $products->description }}</li>
                </ul>

                <div class="mt-4">
                    <!-- Usa la clase product-back-btn -->
                    <a href="{{ route('products.index') }}" class="btn product-back-btn me-2" title="Volver">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Sección de reseñas de clientes --}}
    <div class="reviews-card">
        <h4 class="mb-3">Reseñas de clientes</h4>

        @forelse($products->reviews as $review)
            <div class="review-item">
                <div class="review-meta d-flex align-items-center gap-3 mb-2">
                    <strong>{{ $review->user->name }}</strong>
                    <div class="review-stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa {{ $i <= $review->rating ? 'fa-star text-warning' : 'fa-star text-secondary' }}"></i>
                        @endfor
                    </div>
                </div>

                <p class="mb-1 review-comment">{{ $review->comment }}</p>
                <small class="review-date text-muted">{{ $review->created_at->format('d/m/Y H:i') }}</small>
            </div>
        @empty
            <p class="text-muted">No hay reseñas para este producto todavía.</p>
        @endforelse
    </div>
</div>
@endsection