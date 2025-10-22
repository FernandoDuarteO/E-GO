@extends('layouts.clients')

@section('content')
<div class="container mt-4 clients-products">
    <div class="d-flex align-items-center mb-4">
        <h2 class="mb-0">Productos</h2>
    </div>

    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm border-0 product-card">
                @if($product->media_file)
                    <img src="{{ asset('storage/' . $product->media_file) }}"
                         class="card-img-top"
                         alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/300x200?text=Sin+Imagen"
                         class="card-img-top"
                         alt="Sin imagen">
                @endif

                <div class="card-body p-3">
                    <h6 class="card-title mb-1">{{ $product->name }}</h6>

                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <p class="mb-0 text-muted price" style="font-size:.95rem;">
                              C$ {{ number_format($product->price,2) }}
                            </p>
                            <small class="text-muted d-block" style="font-size:.82rem;">
                              {{ Str::limit($product->description, 60) }}
                            </small>
                        </div>
                        <div class="ms-2 text-end">
                            <span class="badge bg-primary category-badge">{{ $product->category->type ?? 'Sin categoría' }}</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted" style="font-size:.82rem;">{{ $product->vendor_name ?? ($product->user->name ?? 'Emprendedor') }}</small>
                        <div class="product-card-actions">
                            <span class="btn btn-sm custom-purple-btn" aria-hidden="true">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                No hay productos disponibles.
            </div>
        </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        @if(method_exists($products,'links'))
            {{ $products->links() }}
        @endif
    </div>
</div>
@endsection
