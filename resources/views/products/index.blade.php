@extends('layouts.app')

@section('content')

<div class="container py-4">
    <h2 class="mb-4">Mis productos</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        @foreach ($products as $product)
            <div class="col">
                <div class="card product-card h-100 shadow-sm border-0" style="background: #f3f3ff;">
                    @if($product->media_file)
                        <img src="{{ asset('storage/' . $product->media_file) }}" class="card-img-top" alt="Foto" style="height: 180px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/300x180?text=Sin+Imagen" class="card-img-top" alt="Sin foto" style="height: 180px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h6 class="card-title mb-1">{{ $product->name }}</h6>
                        <p class="mb-1 fw-bold">${{ number_format($product->price, 2) }}</p>
                        <p class="mb-0" style="font-size: 0.9em; color: #666;">{{ Str::limit($product->description, 38) }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 d-flex justify-content-center">
                        <a href="{{ route('products.show', $product->id) }}" class="btn custom-purple-btn btn-sm mx-1" title="Ver">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn custom-purple-btn btn-sm mx-1" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn custom-purple-btn btn-sm mx-1" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex flex-column align-items-center mt-5">
        <a href="{{ route('products.create') }}" class="btn btn-outline-primary rounded-circle mb-2" style="width: 56px; height: 56px; font-size: 1.8em; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-plus"></i>
        </a>
        <span class="text-muted">Agrega un nuevo producto</span>
    </div>
</div>
@endsection