@extends('layouts.app')

@section('content')

@php
    // Obtener rutas de imágenes (product_images o legacy media_file)
    $images = [];

    if (isset($products) && method_exists($products, 'images') && $products->relationLoaded('images') && $products->images->isNotEmpty()) {
        $images = $products->images->sortBy('order')->pluck('file_path')->toArray();
    } elseif (isset($products) && method_exists($products, 'images') && $products->images()->exists()) {
        $images = $products->images()->orderBy('order')->pluck('file_path')->toArray();
    } elseif (!empty($products->media_file)) {
        $maybe = @json_decode($products->media_file, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($maybe)) {
            $images = $maybe;
        } else {
            $images = [$products->media_file];
        }
    }

    // Convertir a URLs públicas
    $imageUrls = collect($images)->map(fn($p) => \Illuminate\Support\Facades\Storage::url($p))->toArray();
@endphp

<div class="container product-show-container">
    <h2 class="mb-4">Detalle del producto</h2>

    <div class="card product-detail-card">
        <div class="row gx-4 gy-4 align-items-stretch">
            <!-- Imagen / Carousel -->
            <div class="col-lg-6 col-md-6 product-image-wrap">
                @if(count($imageUrls) === 0)
                    <img src="https://via.placeholder.com/760x480?text=Sin+Imagen"
                         alt="Sin foto"
                         class="product-image img-fluid rounded">
                @elseif(count($imageUrls) === 1)
                    <img src="{{ $imageUrls[0] }}" alt="{{ $products->name ?? 'Producto' }}" class="product-image img-fluid rounded">
                @else
                    <div id="product-carousel" class="w-100">
                        <div class="position-relative">
                            <button id="prevBtn" class="carousel-nav-btn position-absolute left" style="top:50%; transform:translateY(-50%);" aria-label="Anterior">‹</button>

                            <img id="carousel-main-image" src="{{ $imageUrls[0] }}" alt="{{ $products->name ?? 'Producto' }}" class="product-image img-fluid rounded">

                            <button id="nextBtn" class="carousel-nav-btn position-absolute right" style="top:50%; transform:translateY(-50%);" aria-label="Siguiente">›</button>
                        </div>

                        <div id="carousel-indicators" class="mt-3 d-flex flex-wrap justify-content-start">
                            @foreach($imageUrls as $idx => $url)
                                <button class="indicator-btn {{ $idx === 0 ? 'active' : '' }}" data-index="{{ $idx }}" aria-label="Ir a imagen {{ $idx + 1 }}">
                                    <img src="{{ $url }}" alt="Miniatura {{ $idx + 1 }}">
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Info del producto -->
            <div class="col-lg-6 col-md-6 product-info-column">
                <div class="product-info-main">
                    <h3 class="mb-2" style="font-weight:700;">{{ $products->name }}</h3>

                    <div class="mb-3 d-flex align-items-center gap-3">
                        <span class="price-badge">C$ {{ number_format($products->price, 2) }}</span>
                        <span class="text-muted">|</span>
                        <span class="quantity-badge">Cantidad: {{ $products->quantity }}</span>
                    </div>

                    <div class="product-info-list">
                        <p class="mb-2"><strong>Descripción:</strong> <span class="text-muted">{{ $products->description }}</span></p>

                        <p class="mb-2"><strong>Categoría:</strong>
                            <span class="cat-badge">
                                {{ $products->category ? $products->category->type : 'Sin categoría' }}
                            </span>
                        </p>
                    </div>
                </div>

                {{-- Actions block: queda al fondo de la columna gracias a margin-top:auto --}}
                <div class="product-info-actions">
                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ route('products.index') }}" class="product-back-btn" title="Volver">
                            <i class="fas fa-arrow-left me-2"></i> Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Reseñas --}}
    <div class="reviews-card mt-4">
        <h4 class="mb-3">Reseñas de clientes</h4>

        @forelse($products->reviews as $review)
            <div class="review-item mb-3 p-3">
                <div class="review-meta d-flex align-items-center gap-3 mb-2">
                    <div style="width:44px; height:44px; background:#eee; border-radius:8px; display:flex; align-items:center; justify-content:center; font-weight:700;">
                        {{ strtoupper(substr($review->user->name ?? 'U',0,1)) }}
                    </div>
                    <div>
                        <strong>{{ $review->user->name }}</strong>
                        <div class="d-block review-stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa {{ $i <= $review->rating ? 'fa-star text-warning' : 'fa-star text-secondary' }}" aria-hidden="true"></i>
                            @endfor
                        </div>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const images = @json($imageUrls);
    if (!images || images.length <= 1) return;

    let idx = 0;
    const mainImg = document.getElementById('carousel-main-image');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const indicatorBtns = Array.from(document.querySelectorAll('.indicator-btn'));

    function setImage(i, focus = false) {
        idx = (i + images.length) % images.length;
        mainImg.src = images[idx];
        indicatorBtns.forEach((b, k) => {
            b.classList.toggle('active', k === idx);
        });
        if (focus && indicatorBtns[idx]) indicatorBtns[idx].focus();
    }

    prevBtn.addEventListener('click', () => setImage(idx - 1));
    nextBtn.addEventListener('click', () => setImage(idx + 1));

    indicatorBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const i = parseInt(this.getAttribute('data-index'), 10);
            setImage(i, true);
        });
        // keyboard access
        btn.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });

    // keyboard navigation (left / right)
    document.addEventListener('keydown', function (e) {
        if (e.key === 'ArrowLeft') setImage(idx - 1);
        if (e.key === 'ArrowRight') setImage(idx + 1);
    });

    // initialize
    setImage(0);
});
</script>
@endsection