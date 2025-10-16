@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Crear Categoría</h2>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        @include('categories.form', ['btnText' => 'Crear'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
