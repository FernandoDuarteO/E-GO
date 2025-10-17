@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Sidebar de chats -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Mis Chats</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center">
                            <div>
                                <span class="avatar rounded-circle bg-danger text-white me-2 d-inline-flex align-items-center justify-content-center">DE</span>
                                <div class="d-inline-block">
                                    <span>Stain Canvas Accesories</span>
                                    <p class="text-muted small mb-0">Lorem Ipsum has been...</p>
                                </div>
                            </div>
                            <span class="text-muted small">4 min</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div>
                                <span class="avatar rounded-circle bg-danger text-white me-2 d-inline-flex align-items-center justify-content-center">DE</span>
                                <div class="d-inline-block">
                                    <span>Besabelle</span>
                                    <p class="text-muted small mb-0">La dirección es del...</p>
                                </div>
                            </div>
                            <span class="text-muted small">5 min</span>
                        </li>
                        <!-- Agrega más elementos según sea necesario -->
                    </ul>
                </div>
            </div>
        </div>

        <!-- Ventana de chat -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center bg-white">
                    <span class="avatar rounded-circle bg-danger text-white me-2 d-inline-flex align-items-center justify-content-center">DE</span>
                    <h5 class="mb-0">Stain Canvas Accesories</h5>
                </div>
                <div class="card-body" style="height: 400px; overflow-y: auto; background-color: #f0f4ff;">
                    <!-- Mensajes del chat -->
                    <div class="d-flex align-items-center mb-3">
                        <span class="avatar rounded-circle bg-danger text-white me-2 d-inline-flex align-items-center justify-content-center">DE</span>
                        <div class="text-start bg-white p-2 rounded" style="max-width: 70%;">
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            <small class="text-muted d-block mt-1">8:00 PM</small>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mb-3">
                        <div class="text-end bg-primary text-white p-2 rounded" style="max-width: 70%;">
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            <small class="text-muted d-block mt-1">8:00 PM</small>
                        </div>
                        <span class="avatar rounded-circle bg-danger text-white ms-2 d-inline-flex align-items-center justify-content-center">DE</span>
                    </div>
                    <!-- Agrega más mensajes según sea necesario -->
                </div>
                <div class="card-footer bg-white">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Escribir mensaje" style="border-radius: 25px;">
                            <button class="btn btn-primary ms-2" type="submit" style="border-radius: 50%; width: 50px; height: 50px;">
                                <i class="bi bi-send fs-5"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection