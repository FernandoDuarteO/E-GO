@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="ego-card d-flex flex-row" style="max-width:820px; width:100%;">
            <div class="ego-side col-5 p-5">
                <img src="{{ asset('assets/images/E-GO_LOGO.png') }}" alt="Logo" style="width:120px;">
                <div class="ego-subtitle">¡Emprende ahora!</div>
            </div>
            <div class="col-7 px-5 py-4 d-flex flex-column justify-content-center align-items-center">
                <div class="text-center mb-1">
                    <h3 class="fw-bold mb-0">Crear cuenta</h3>
                    <div class="mb-3" style="font-size: 0.95rem;">
                        ¿Ya tienes una cuenta?
                        <a href="{{ route('login') }}" class="ego-form-link">Inicia sesión</a>
                    </div>
                </div>
                <div class="ego-btn-group mb-2">
                    <button type="button" class="ego-btn-radio active" data-role="client" id="btn-client">Cliente</button>
                    <button type="button" class="ego-btn-radio" data-role="entrepreneur" id="btn-entrepreneur">Emprendedor</button>
                </div>
                <form method="POST" action="{{ route('register') }}" id="register-form" class="w-100" style="max-width:340px;">
                    @csrf
                    <input type="hidden" name="role" id="roleInput" value="client">

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <input type="text" class="form-control ego-form-input" name="name" placeholder="Nombre completo" value="{{ old('name') }}" required autofocus>
                    <input type="email" class="form-control ego-form-input" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
                    <input type="password" class="form-control ego-form-input" name="password" placeholder="Contraseña" required>
                    <input type="password" class="form-control ego-form-input" name="password_confirmation" placeholder="Confirmar contraseña" required>

                    <!-- Botón Siguiente solo para Emprendedor -->
                    <button type="button" class="btn ego-btn-main w-100 mb-2" id="btn-next-entrepreneur" style="display:none;">Siguiente</button>
                    <!-- Botón Registrar solo para Cliente -->
                    <button type="submit" class="btn ego-btn-main w-100" id="btn-register-client">Registrarme</button>
                    <a href="{{ route('auth.redirect') }}" class="btn ego-btn-facebook w-100 mb-2" id="fb-register-btn">
                        <i class="bi bi-facebook me-2"></i> Registrarme con Facebook
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Cambiar el rol al hacer click en los botones
    document.querySelectorAll('.ego-btn-radio').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.ego-btn-radio').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('roleInput').value = this.getAttribute('data-role');
            if(this.getAttribute('data-role') === 'entrepreneur') {
                document.getElementById('btn-next-entrepreneur').style.display = 'block';
                document.getElementById('btn-register-client').style.display = 'none';
            } else {
                document.getElementById('btn-next-entrepreneur').style.display = 'none';
                document.getElementById('btn-register-client').style.display = 'block';
            }
        });
    });

    // PREVIENE EL SUBMIT DEL FORMULARIO SI ES EMPRENDEDOR
    document.getElementById('register-form').addEventListener('submit', function(e) {
        var role = document.getElementById('roleInput').value;
        if(role === 'entrepreneur') {
            e.preventDefault(); // Nunca envía como submit normal si es emprendedor
        }
        // Si es cliente, sí deja el submit normal
    });

    // Botón "Siguiente" para emprendedor: envía datos por POST a la vista de emprendimiento
    document.getElementById('btn-next-entrepreneur').addEventListener('click', function(e) {
    e.preventDefault();
    var form = document.getElementById('register-form');
    var data = new FormData(form);
    var tempForm = document.createElement('form');
    tempForm.method = 'POST';
    tempForm.action = "{{ route('register.entrepreneur') }}"; // <-- AQUÍ VA ESTA LÍNEA
    tempForm.style.display = 'none';

    var csrf = document.querySelector('input[name=\"_token\"]');
    tempForm.appendChild(csrf.cloneNode(true));

    for(var [key, value] of data.entries()) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = value;
        tempForm.appendChild(input);
    }
    document.body.appendChild(tempForm);
    tempForm.submit();
});

    // Modifica el href del botón de Facebook para agregar el rol como query
    document.getElementById('fb-register-btn').addEventListener('click', function(e) {
        e.preventDefault();
        var role = document.getElementById('roleInput').value;
        window.location.href = "{{ route('auth.redirect') }}" + "?role=" + role;
    });
</script>
@endsection
