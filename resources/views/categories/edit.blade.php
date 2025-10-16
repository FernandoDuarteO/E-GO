@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Editar Categoría</h2>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <form action="{{ route('categories.update', $categories->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('categories.form', ['categories' => $categories, 'btnText' => 'Actualizar'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
