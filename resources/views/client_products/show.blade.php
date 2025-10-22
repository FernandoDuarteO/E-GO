@extends('layouts.clients')

@section('content')
<div class="container mt-4 clients-products">
    <div class="row g-4">
        <!-- Imagen / galería -->
        <div class="col-12 col-md-6">
            <div class="card h-100 border-0 shadow-sm product-media-card">
                @if($product->media_file)
                    <img src="{{ asset('storage/' . $product->media_file) }}" class="card-img-top" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/600x480?text=Sin+Imagen" class="card-img-top" alt="Sin imagen">
                @endif
            </div>
        </div>

        <!-- Información y acciones -->
        <div class="col-12 col-md-6">
            <div class="card h-100 border-0 shadow-sm p-3 product-info-card">
                <div class="card-body">
                    <h3 class="card-title mb-2">{{ $product->name }}</h3>

                    <p class="mb-1"><strong>Precio:</strong> C$ {{ number_format($product->price,2) }}</p>
                    <p class="mb-1"><strong>Cantidad:</strong> {{ $product->quantity }}</p>
                    <p class="mb-1">
                        <strong>Categoría:</strong>
                        <span class="badge bg-primary">{{ $product->category->type ?? 'Sin categoría' }}</span>
                    </p>

                    <hr>

                    <p class="card-text text-muted">{{ $product->description }}</p>

                    <div class="mt-3 d-flex gap-2">
                        <a href="{{ route('clients.products') }}" class="btn btn-outline-secondary">Volver</a>

                        @if(Auth::check())
                            <a href="#review-form" class="btn btn-primary">Escribir reseña</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión para reseñar</a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Reseñas --}}
            <div class="card mt-4 border-0 shadow-sm p-3 reviews-card">
                <div class="card-body">
                    <h5 class="mb-3">Reseñas</h5>

                    @forelse($product->reviews as $review)
                        <div class="mb-3 p-2 border rounded review-item">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <strong>{{ $review->user->name }}</strong>
                                <small class="text-muted">{{ $review->created_at->format('d/m/Y H:i') }}</small>
                            </div>

                            <div class="mb-2">
                                @for($i=1;$i<=5;$i++)
                                    <i class="fa {{ $i <= $review->rating ? 'fa-star text-warning' : 'fa-star text-secondary' }}"></i>
                                @endfor
                            </div>

                            <p class="mb-0">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <p class="text-muted">No hay reseñas aún. Sé el primero en reseñar este producto.</p>
                    @endforelse

                    {{-- Formulario de reseña --}}
                    <div id="review-form" class="mt-4">
                        @auth
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="mb-2">
                                <label for="rating" class="form-label">Calificación</label>
                                <select name="rating" id="rating" class="form-select" required>
                                    <option value="">Selecciona...</option>
                                    @for($i=1;$i<=5;$i++)
                                        <option value="{{ $i }}">{{ $i }} estrella{{ $i>1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="comment" class="form-label">Comentario</label>
                                <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar reseña</button>
                        </form>
                        @else
                        <p class="text-muted">Debes <a href="{{ route('login') }}">iniciar sesión</a> para enviar una reseña.</p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection