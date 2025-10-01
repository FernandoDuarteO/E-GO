@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Editar producto</h2>
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <!-- El formulario debe envolver el include del form -->
            <form action="{{ route('products.update', $products->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex gap-4 mb-4 flex-wrap justify-content-start">
    <!-- Imagen real -->
    <div class="bg-white rounded-4 shadow-sm p-2" style="width:220px; height:220px; display: flex; align-items: center; justify-content: center;">
        @if(optional($products)->media_file)
            <img src="{{ asset('storage/' . $products->media_file) }}"
                alt="Foto actual"
                class="img-fluid rounded-3"
                style="width: 100%; height: 100%; object-fit: cover;">
        @else
            <span class="fs-1 text-muted">+</span>
        @endif
    </div>
    <!-- 3 cuadros visuales para imagen -->
    @for ($i = 0; $i < 3; $i++)
    <div class="bg-light rounded-4 shadow-sm p-2 d-flex align-items-center justify-content-center" style="width:220px; height:220px;">
        <span class="fs-1 text-muted">+</span>
    </div>
    @endfor
</div>

                @method('PUT')
                @include('products.form', ['products' => $products, 'btnText' => 'Actualizar'])
            </form>

        </div>
    </div>
</div>
@endsection
