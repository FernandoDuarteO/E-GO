@extends('layouts.clients')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Productos</h2>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm">
                @if($product->media_file)
                    <img src="{{ asset('storage/' . $product->media_file) }}"
                         class="card-img-top"
                         alt="{{ $product->name }}"
                         style="object-fit:cover; height:180px;">
                @else
                    <img src="https://via.placeholder.com/180x180?text=Sin+Imagen"
                         class="card-img-top"
                         alt="Sin imagen"
                         style="object-fit:cover; height:180px;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="mb-1"><span class="badge bg-primary">{{ $product->category->type ?? 'Sin categoría' }}</span></p>
                    <p class="card-text">Cantidad: {{ $product->quantity }}</p>
                    <p class="card-text">C$ {{ number_format($product->price, 2) }}</p>
                    <p class="card-text">{{ $product->description }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
