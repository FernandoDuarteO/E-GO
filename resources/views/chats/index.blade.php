@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modules/chats.css') }}">
<div class="chat-container d-flex">
    <div class="chat-sidebar p-3 bg-white border-end">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 text-dark">Chats Recientes</h5>
            <button class="btn btn-primary btn-sm rounded-pill"><i class="fas fa-plus me-1"></i> Nuevo Chat</button>
        </div>

        <div class="input-group mb-4">
            <input type="text" class="form-control rounded-pill" placeholder="Buscar..." aria-label="Buscar">
        </div>

        <div class="chat-list-scrollable">
            <a href="#" class="chat-list-item active d-flex align-items-center p-2 mb-2 rounded-3">
                <img src="https://via.placeholder.com/50" alt="Avatar" class="avatar me-3 rounded-circle">
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-dark">Nika Jerrardo</h6>
                        <small class="text-primary fw-bold">1m</small>
                    </div>
                    <p class="mb-0 text-truncate small">¡Hola! Encontré tu ayuda...</p>
                </div>
            </a>

            <a href="#" class="chat-list-item d-flex align-items-center p-2 mb-2 rounded-3">
                <img src="https://via.placeholder.com/50" alt="Avatar" class="avatar me-3 rounded-circle">
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-dark">Jared Sunn</h6>
                        <small class="text-muted">3d</small>
                    </div>
                    <p class="mb-0 text-truncate small">grabó un mensaje de voz...</p>
                </div>
            </a>

            <a href="#" class="chat-list-item d-flex align-items-center p-2 mb-2 rounded-3">
                <img src="https://via.placeholder.com/50" alt="Avatar" class="avatar me-3 rounded-circle">
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-dark">David Amrosa</h6>
                        <small class="text-muted">5d</small>
                    </div>
                    <p class="mb-0 text-truncate small">Por favor, mira nuestra nueva...</p>
                </div>
            </a>
        </div>
    </div>

    <div class="chat-main flex-grow-1 d-flex flex-column bg-light">
        <div class="chat-header-main p-3 bg-white border-bottom d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="https://via.placeholder.com/50" alt="Avatar" class="avatar me-3 rounded-circle">
                <div>
                    <h5 class="mb-0 text-dark">Nika Jerrardo</h5>
                    <small class="text-success">En línea hace 5 horas</small>
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-light rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                </div>
        </div>

        <div class="message-area p-4 flex-grow-1 overflow-auto">
            <div class="message-bubble sent ms-auto p-2 mb-3 rounded-3 shadow-sm">
                <p class="mb-0">¡Hey! Okay, seguro. Envía.</p>
                <small class="text-muted d-block text-end">4 days ago</small>
            </div>

            <div class="message-bubble received p-2 mb-3 rounded-3 shadow-sm">
                <p class="mb-0">Hello! Finally found the time to write to you! I need your help in creating interactive animations for my mobile application.</p>
                <small class="text-muted d-block">5 days ago</small>
            </div>

            <div class="message-bubble received p-2 mb-3 rounded-3 shadow-sm file-message">
                <i class="fas fa-file-archive me-2 text-primary"></i>
                <a href="#" class="text-dark">Style.zip</a>
                <small class="d-block text-muted">41.35 Mb</small>
                <small class="text-muted d-block mt-1">4 days ago</small>
            </div>

        </div>

        <div class="chat-input-area p-3 bg-white border-top">
            <div class="input-group">
                <button class="btn btn-light rounded-circle me-2" type="button" title="Adjuntar"><i class="fas fa-paperclip"></i></button>
                <button class="btn btn-light rounded-circle me-2" type="button" title="Emoji"><i class="far fa-smile"></i></button>
                <input type="text" class="form-control rounded-pill me-2" placeholder="Escribe un mensaje aquí...">
                <button class="btn btn-primary rounded-circle" type="button" title="Enviar"><i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
