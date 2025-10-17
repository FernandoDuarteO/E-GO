@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card chat-container">
                <div class="card-body p-0">
                    <div class="row h-100">
                        <!-- Sidebar con lista de contactos -->
                        <div class="col-md-4 col-lg-3 p-0 sidebar">
                            <!-- Búsqueda CORREGIDA -->
                            <div class="search-box p-3">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" placeholder="Buscar conversaciones...">
                                </div>
                            </div>
                            
                            <!-- Lista de contactos -->
                            <div class="contact-list">
                                <!-- Vendedor activo -->
                                <div class="contact-item active" data-user="vendedor" data-name="María Alonso">
                                    <div class="contact-avatar">MA</div>
                                    <div class="contact-info">
                                        <div class="contact-name">María Alonso</div>
                                        <div class="contact-last-message">Perfecto, nos vemos a la ...</div>
                                    </div>
                                    <div class="contact-time">10:45</div>
                                    <div class="online-indicator"></div>
                                </div>
                                
                                <!-- Comprador -->
                                <div class="contact-item" data-user="comprador" data-name="Carlos Rodríguez">
                                    <div class="contact-avatar" style="background-color: #FFC212;">CR</div>
                                    <div class="contact-info">
                                        <div class="contact-name">Carlos Rodríguez</div>
                                        <div class="contact-last-message">¿Has revisado el docum...</div>
                                    </div>
                                    <div class="contact-time">09:32</div>
                                    <div class="online-indicator"></div>
                                </div>
                                
                                <!-- Vendedor -->
                                <div class="contact-item" data-user="vendedor" data-name="Ana García">
                                    <div class="contact-avatar">AG</div>
                                    <div class="contact-info">
                                        <div class="contact-name">Ana García</div>
                                        <div class="contact-last-message">Gracias por la ayuda con el ...</div>
                                    </div>
                                    <div class="contact-time">Ayer</div>
                                </div>
                                
                                <!-- Comprador -->
                                <div class="contact-item" data-user="comprador" data-name="Javier López">
                                    <div class="contact-avatar" style="background-color: #FFC212;">JL</div>
                                    <div class="contact-info">
                                        <div class="contact-name">Javier López</div>
                                        <div class="contact-last-message">La reunión se pospone para ...</div>
                                    </div>
                                    <div class="contact-time">Ayer</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Área de chat principal -->
                        <div class="col-md-8 col-lg-9 p-0 d-flex flex-column">
                            <!-- Encabezado del chat -->
                            <div class="chat-header">
                                <div class="d-flex align-items-center">
                                    <div class="contact-avatar me-3">MA</div>
                                    <div>
                                        <h5 class="mb-0">María Alonso</h5>
                                        <small>En línea</small>
                                    </div>
                                    <div class="ms-auto">
                                        <span class="badge bg-warning text-dark">Vendedor</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Mensajes -->
                            <div class="chat-messages">
                                <!-- Mensaje recibido (Vendedor) -->
                                <div class="message received">
                                    <div class="message-bubble">
                                        <div class="message-text">Hola, ¿cómo estás?</div>
                                        <div class="message-time">10:30</div>
                                    </div>
                                </div>
                                
                                <!-- Mensaje recibido (Vendedor) -->
                                <div class="message received">
                                    <div class="message-bubble">
                                        <div class="message-text">Todo bien por aquí. Oye, ¿has visto el nuevo diseño que propuse?</div>
                                        <div class="message-time">10:33</div>
                                    </div>
                                </div>
                                
                                <!-- Mensaje enviado (Tú como Comprador) -->
                                <div class="message sent">
                                    <div class="message-bubble">
                                        <div class="message-text">Sí, me encanta. Los colores quedan geniales, especialmente el morado y amarillo.</div>
                                        <div class="message-time">10:35</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Área de escritura de mensajes -->
                            <div class="chat-input-area">
                                <div class="message-actions">
                                    <button class="btn btn-icon" type="button" title="Adjuntar archivo">
                                        <i class="fas fa-paperclip"></i>
                                    </button>
                                    <button class="btn btn-icon" type="button" title="Emojis">
                                        <i class="fas fa-smile"></i>
                                    </button>
                                    <button class="btn btn-icon" type="button" title="Imágenes">
                                        <i class="fas fa-image"></i>
                                    </button>
                                </div>
                                <div class="message-input-container">
                                    <textarea class="message-input" placeholder="Escribe un mensaje..." rows="1"></textarea>
                                    <button class="btn btn-send" type="button" title="Enviar mensaje">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                                <div class="typing-indicator">
                                    <span class="typing-text">María está escribiendo...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --color-white: #FFFFFF;
        --color-light-bg: #EBEBEB;
        --color-light-purple: #EDDFFD;
        --color-purple: #7766C6;
        --color-yellow: #FFC212;
    }
    
    .chat-container {
        height: 80vh;
        background-color: var(--color-white);
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    
    /* BUSCADOR CORREGIDO */
    .search-box {
        background-color: var(--color-white);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .search-box .input-group {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        border-radius: 8px;
        overflow: hidden;
    }
    
    .search-box .input-group-text {
        background-color: var(--color-white);
        border: 1px solid #dee2e6;
        border-right: none;
        padding: 0.5rem 0.75rem;
    }
    
    .search-box .form-control {
        border: 1px solid #dee2e6;
        border-left: none;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
    }
    
    .search-box .form-control:focus {
        box-shadow: none;
        border-color: #dee2e6;
    }
    
    .search-box .input-group-sm .input-group-text {
        padding: 0.375rem 0.75rem;
    }
    
    .search-box .input-group-sm .form-control {
        padding: 0.375rem 0.75rem;
    }
    
    .chat-header {
        background-color: var(--color-purple);
        color: white;
        padding: 15px 20px;
        border-radius: 0;
    }
    
    .chat-messages {
        padding: 20px;
        height: calc(100% - 180px);
        overflow-y: auto;
        background-color: var(--color-light-bg);
    }
    
    .message {
        margin-bottom: 15px;
        display: flex;
        align-items: flex-start;
    }
    
    .message.received {
        justify-content: flex-start;
    }
    
    .message.sent {
        justify-content: flex-end;
    }
    
    .message-bubble {
        max-width: 70%;
        padding: 12px 15px;
        border-radius: 18px;
        position: relative;
    }
    
    .received .message-bubble {
        background-color: var(--color-white);
        border-bottom-left-radius: 5px;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    
    .sent .message-bubble {
        background-color: var(--color-purple);
        color: white;
        border-bottom-right-radius: 5px;
    }
    
    .message-time {
        font-size: 0.75rem;
        opacity: 0.7;
        margin-top: 5px;
        text-align: right;
    }
    
    /* Área de escritura */
    .chat-input-area {
        padding: 15px 20px;
        background-color: var(--color-white);
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }
    
    .message-actions {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }
    
    .btn-icon {
        background: none;
        border: none;
        color: var(--color-purple);
        font-size: 1.1rem;
        padding: 5px 10px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-icon:hover {
        background-color: var(--color-light-purple);
        color: var(--color-purple);
    }
    
    .message-input-container {
        display: flex;
        align-items: flex-end;
        gap: 10px;
        background-color: var(--color-light-bg);
        border-radius: 12px;
        padding: 10px 15px;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    
    .message-input {
        flex: 1;
        border: none;
        background: none;
        resize: none;
        outline: none;
        font-size: 0.95rem;
        line-height: 1.4;
        max-height: 120px;
        min-height: 20px;
        font-family: inherit;
    }
    
    .message-input:focus {
        box-shadow: none;
    }
    
    .message-input::placeholder {
        color: #999;
    }
    
    .btn-send {
        background-color: var(--color-yellow);
        border: none;
        color: #333;
        font-weight: 600;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }
    
    .btn-send:hover {
        background-color: #e6b000;
        transform: scale(1.05);
    }
    
    .btn-send:disabled {
        background-color: #ccc;
        cursor: not-allowed;
        transform: none;
    }
    
    .typing-indicator {
        height: 20px;
        margin-top: 5px;
        padding: 0 10px;
    }
    
    .typing-text {
        font-size: 0.8rem;
        color: var(--color-purple);
        font-style: italic;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .typing-indicator.active .typing-text {
        opacity: 1;
    }
    
    .contact-list {
        padding: 0;
    }
    
    .contact-item {
        padding: 12px 15px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        cursor: pointer;
        transition: background-color 0.2s;
        display: flex;
        align-items: center;
        background-color: var(--color-white);
    }
    
    .contact-item:hover, .contact-item.active {
        background-color: rgba(119, 102, 198, 0.1);
    }
    
    .contact-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--color-purple);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        margin-right: 12px;
        flex-shrink: 0;
        font-size: 0.9rem;
    }
    
    .contact-info {
        flex: 1;
        min-width: 0;
    }
    
    .contact-name {
        font-weight: 600;
        margin-bottom: 2px;
        color: #333;
        font-size: 0.9rem;
    }
    
    .contact-last-message {
        font-size: 0.8rem;
        color: #666;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .contact-time {
        font-size: 0.7rem;
        color: #999;
        flex-shrink: 0;
        margin-left: 8px;
    }
    
    .online-indicator {
        width: 8px;
        height: 8px;
        background-color: #4CAF50;
        border-radius: 50%;
        margin-left: 8px;
        flex-shrink: 0;
    }
    
    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatMessages = document.querySelector('.chat-messages');
        const messageInput = document.querySelector('.message-input');
        const sendButton = document.querySelector('.btn-send');
        const typingIndicator = document.querySelector('.typing-indicator');
        
        // Auto-scroll al final de los mensajes
        chatMessages.scrollTop = chatMessages.scrollHeight;
        
        // Auto-ajustar altura del textarea
        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
            
            // Habilitar/deshabilitar botón de enviar
            sendButton.disabled = this.value.trim() === '';
        });
        
        // Enviar mensaje
        function sendMessage() {
            const messageText = messageInput.value.trim();
            
            if (messageText) {
                // Crear elemento de mensaje
                const messageDiv = document.createElement('div');
                messageDiv.className = 'message sent';
                
                const bubbleDiv = document.createElement('div');
                bubbleDiv.className = 'message-bubble';
                
                const textDiv = document.createElement('div');
                textDiv.className = 'message-text';
                textDiv.textContent = messageText;
                
                const timeDiv = document.createElement('div');
                timeDiv.className = 'message-time';
                
                const now = new Date();
                timeDiv.textContent = `${now.getHours()}:${now.getMinutes().toString().padStart(2, '0')}`;
                
                bubbleDiv.appendChild(textDiv);
                bubbleDiv.appendChild(timeDiv);
                messageDiv.appendChild(bubbleDiv);
                
                // Agregar mensaje al chat
                chatMessages.appendChild(messageDiv);
                
                // Limpiar input y resetear altura
                messageInput.value = '';
                messageInput.style.height = 'auto';
                sendButton.disabled = true;
                
                // Scroll al final
                chatMessages.scrollTop = chatMessages.scrollHeight;
                
                // Simular que el otro usuario está escribiendo
                simulateTyping();
            }
        }
        
        // Simular que el otro usuario está escribiendo
        function simulateTyping() {
            typingIndicator.classList.add('active');
            
            setTimeout(() => {
                typingIndicator.classList.remove('active');
                
                // Simular respuesta automática después de 2 segundos
                setTimeout(() => {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'message received';
                    
                    const bubbleDiv = document.createElement('div');
                    bubbleDiv.className = 'message-bubble';
                    
                    const textDiv = document.createElement('div');
                    textDiv.className = 'message-text';
                    textDiv.textContent = '¡Gracias por tu mensaje! Te responderé pronto.';
                    
                    const timeDiv = document.createElement('div');
                    timeDiv.className = 'message-time';
                    
                    const now = new Date();
                    timeDiv.textContent = `${now.getHours()}:${now.getMinutes().toString().padStart(2, '0')}`;
                    
                    bubbleDiv.appendChild(textDiv);
                    bubbleDiv.appendChild(timeDiv);
                    messageDiv.appendChild(bubbleDiv);
                    
                    chatMessages.appendChild(messageDiv);
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }, 1000);
            }, 2000);
        }
        
        // Event listeners
        sendButton.addEventListener('click', sendMessage);
        
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
        
        // Cambiar contacto activo al hacer clic
        document.querySelectorAll('.contact-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.contact-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
                
                // Actualizar header del chat
                const contactName = this.getAttribute('data-name');
                const userType = this.getAttribute('data-user');
                const header = document.querySelector('.chat-header');
                
                document.querySelector('.chat-header h5').textContent = contactName;
                
                // Actualizar badge según el tipo de usuario
                const badge = header.querySelector('.badge');
                if (userType === 'vendedor') {
                    badge.textContent = 'Vendedor';
                    badge.className = 'badge bg-warning text-dark';
                } else {
                    badge.textContent = 'Comprador';
                    badge.className = 'badge bg-info';
                }
                
                // Actualizar avatar en header
                const headerAvatar = header.querySelector('.contact-avatar');
                const contactAvatar = this.querySelector('.contact-avatar');
                headerAvatar.textContent = contactAvatar.textContent;
                headerAvatar.style.backgroundColor = contactAvatar.style.backgroundColor || '';
                
                // Limpiar y cargar nuevos mensajes (simulado)
                const chatMessages = document.querySelector('.chat-messages');
                chatMessages.innerHTML = '';
                
                // Simular mensajes según el tipo de usuario
                if (userType === 'vendedor') {
                    // Mensajes con vendedor
                    chatMessages.innerHTML = `
                        <div class="message received">
                            <div class="message-bubble">
                                <div class="message-text">Hola, ¿en qué puedo ayudarte?</div>
                                <div class="message-time">10:15</div>
                            </div>
                        </div>
                        <div class="message sent">
                            <div class="message-bubble">
                                <div class="message-text">Hola, me interesa el producto que publicaste</div>
                                <div class="message-time">10:16</div>
                            </div>
                        </div>
                    `;
                } else {
                    // Mensajes con comprador
                    chatMessages.innerHTML = `
                        <div class="message received">
                            <div class="message-bubble">
                                <div class="message-text">Buen día, ¿tienes disponibilidad?</div>
                                <div class="message-time">09:20</div>
                            </div>
                        </div>
                        <div class="message sent">
                            <div class="message-bubble">
                                <div class="message-text">Sí, tenemos stock disponible</div>
                                <div class="message-time">09:22</div>
                            </div>
                        </div>
                    `;
                }
                
                chatMessages.scrollTop = chatMessages.scrollHeight;
                messageInput.value = '';
                messageInput.style.height = 'auto';
                sendButton.disabled = true;
                typingIndicator.classList.remove('active');
            });
        });
    });
</script>
@endsection