@extends('layouts.app')

@section('content')
<div class="container py-4 products-container">
    <h2 class="mb-4 products-header">Mis productos</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 products-grid">
        @foreach ($products as $product)
            <div class="col">
                <div class="card product-card h-100 shadow-sm border-0">
                    @if($product->media_file)
                        <img src="{{ asset('storage/' . $product->media_file) }}" class="card-img-top" alt="Foto">
                    @else
                        <img src="https://via.placeholder.com/300x180?text=Sin+Imagen" class="card-img-top" alt="Sin foto">
                    @endif

                    <div class="card-body product-body">
                        <h6 class="card-title mb-1 product-title">{{ $product->name }}</h6>
                        <p class="mb-1 fw-bold product-price">C${{ number_format($product->price, 2) }}</p>
                        <p class="mb-0 product-desc">{{ Str::limit($product->description, 38) }}</p>
                        <p class="mb-0 product-category">
                            <span class="fw-semibold">Categoría:</span>
                            {{ $product->category ? $product->category->type : 'Sin categoría' }}
                        </p>
                    </div>

                    <div class="card-footer bg-transparent border-0 d-flex justify-content-center product-actions">
                        <a href="{{ route('products.show', $product->id) }}" class="custom-purple-btn btn-sm mx-1" title="Ver" aria-label="Ver producto">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('products.edit', $product->id) }}" class="custom-purple-btn btn-sm mx-1" title="Editar" aria-label="Editar producto">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="custom-purple-btn btn-sm mx-1" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este producto?')" aria-label="Eliminar producto">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex flex-column align-items-center mt-5">
        <a href="{{ route('products.create') }}" class="add-product-cta" title="Agregar producto" aria-label="Agregar producto">
            <i class="fas fa-plus"></i>
        </a>
        <span class="text-muted">Agrega un nuevo producto</span>
    </div>
</div>
@endsection