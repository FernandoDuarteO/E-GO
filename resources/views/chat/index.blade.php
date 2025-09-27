@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1>Chat</h1>
</div>

<div class="content-section">
    <div class="chat-container">
        <div class="chat-sidebar">
            <div class="chat-search">
                <input type="text" placeholder="Buscar conversaciones...">
            </div>
            <div class="chat-list">
                <div class="chat-item active">
                    <div class="chat-avatar">U</div>
                    <div class="chat-info">
                        <div class="chat-name">Usuario Ejemplo</div>
                        <div class="chat-preview">Último mensaje...</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-main">
            <div class="chat-messages">
                <div class="message received">
                    <div class="message-content">Hola, ¿cómo estás?</div>
                    <div class="message-time">10:30 AM</div>
                </div>
                <div class="message sent">
                    <div class="message-content">¡Hola! Estoy bien, gracias.</div>
                    <div class="message-time">10:31 AM</div>
                </div>
            </div>
            <div class="chat-input">
                <input type="text" placeholder="Escribe un mensaje...">
                <button class="btn-send">Enviar</button>
            </div>
        </div>
    </div>
</div>
@endsection
