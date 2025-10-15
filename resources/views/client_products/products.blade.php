@extends('layouts.clients')

@section('content')
<div class="container mt-4">
    <div class="d-flex align-items-center mb-4">
        <button class="btn btn-light rounded-pill px-4 py-2 fw-semibold shadow-sm me-3"
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#categoryModal">
            <i class="fa fa-list me-2"></i> Categorías
        </button>
        <h2 class="mb-0">Productos</h2>
    </div>

    <!-- Modal de categorías -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background: #ede8fd;">
          <div class="modal-header border-0">
            <h5 class="modal-title" id="categoryModalLabel">Categorías</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <div class="row justify-content-center">
              @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-3 mb-4 d-flex justify-content-center">
                  <form method="GET" action="{{ route('clients.products') }}">
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <button type="submit" class="btn w-100 h-100 d-flex flex-column align-items-center py-3 shadow-sm"
                            style="border-radius: 50%; background: #fff;">
                      <div style="width:70px;height:70px;background:#d6cbfa;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                        <i class="fa {{ $category->icon ?? 'fa-tag' }} fa-2x" style="color:#6A5ACD;"></i>
                      </div>
                      <span class="mt-2 fw-semibold text-dark">{{ $category->type }}</span>
                    </button>
                  </form>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Si hay una categoría seleccionada, la mostramos arriba de los productos --}}
    @if(isset($selectedCategory) && $selectedCategory)
        <div class="mb-3">
            <span class="fw-bold">Filtrando por categoría:</span>
            <span class="badge bg-primary">
                {{ $categories->firstWhere('id', $selectedCategory)->type }}
            </span>
            <a href="{{ route('clients.products') }}" class="btn btn-sm btn-outline-secondary ms-2">Ver todas</a>
        </div>
    @endif

    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card h-100 shadow-sm border-0" style="background: #fff; border-radius: 14px;">
                @if($product->media_file)
                    <img src="{{ asset('storage/' . $product->media_file) }}"
                         class="card-img-top"
                         alt="{{ $product->name }}"
                         style="object-fit:cover; height:160px; border-radius: 14px 14px 0 0;">
                @else
                    <img src="https://via.placeholder.com/160x160?text=Sin+Imagen"
                         class="card-img-top"
                         alt="Sin imagen"
                         style="object-fit:cover; height:160px; border-radius: 14px 14px 0 0;">
                @endif
                <div class="card-body p-2">
                    <h6 class="card-title mb-1" style="font-size: 1rem;">{{ $product->name }}</h6>
                    <p class="mb-1" style="font-size: .9rem;"><span class="badge bg-primary">{{ $product->category->type ?? 'Sin categoría' }}</span></p>
                    <p class="card-text mb-1" style="font-size: .9rem;">Cantidad: {{ $product->quantity }}</p>
                    <p class="card-text mb-1" style="font-size: .9rem;">C$ {{ number_format($product->price, 2) }}</p>
                    <p class="card-text" style="font-size: .9rem;">{{ $product->description }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                No hay productos en esta categoría.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
