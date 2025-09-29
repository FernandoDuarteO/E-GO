@extends('layouts.app')

@section('content')
<div class="p-4 rounded" style="background:#dedffc;">
    <h2 class="fw-bold mb-4">Editar producto</h2>

    <form>
        <div class="row">
            <!-- Sección izquierda -->
            <div class="col-md-8">
                <!-- Galería -->
                <div class="d-flex flex-wrap gap-3 mb-3">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="img-upload-box position-relative">
                            <label for="imagen{{ $i }}" class="upload-label w-100 h-100">
                                <span class="plus-icon">+</span>
                                <img id="preview{{ $i }}" class="preview-img d-none" alt="Preview">
                            </label>
                            <input type="file" id="imagen{{ $i }}" class="d-none"
                                   accept="image/*" onchange="previewImage(event, {{ $i }})">

                            <!-- Botón eliminar -->
                            <button type="button" class="btn-remove d-none" id="remove{{ $i }}"
                                    onclick="removeImage({{ $i }})">&times;</button>
                        </div>
                    @endfor
                </div>

                <!-- Descripción -->
                <div class="mb-3">
                    <textarea class="form-control custom-input" rows="4" maxlength="2200"
                              placeholder="Editar descripción...">Recordatorios para XV años.
Pulseras personalizadas con tus colores favoritos
.
.
.
Contáctanos: 8918-7562</textarea>
                    <small class="text-muted">25/2200</small>
                </div>
            </div>

            <!-- Sección derecha -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label fw-bold">Precio:</label>
                    <input type="text" class="form-control custom-input" value="C$50.00">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Disponible:</label>
                    <select class="form-control custom-input">
                        <option selected>Sí</option>
                        <option>No</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Cantidad:</label>
                    <input type="number" class="form-control custom-input" value="25">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Tamaño:</label>
                    <input type="text" class="form-control custom-input" placeholder="Ej. Mediano">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Tipo:</label>
                    <select class="form-control custom-input">
                        <option>Accesorio</option>
                        <option>Ropa</option>
                        <option>Decoración</option>
                        <option selected>Otro</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary me-2 px-4 custom-btn">Guardar</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary px-4 custom-btn">Cancelar</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event, index) {
        let input = event.target;
        let reader = new FileReader();
        reader.onload = function(){
            let img = document.getElementById('preview' + index);
            img.src = reader.result;
            img.classList.remove('d-none');
            document.getElementById('remove' + index).classList.remove('d-none');
            input.previousElementSibling.querySelector('.plus-icon').style.display = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    }

    function removeImage(index) {
        let img = document.getElementById('preview' + index);
        let removeBtn = document.getElementById('remove' + index);
        img.src = '';
        img.classList.add('d-none');
        removeBtn.classList.add('d-none');
        document.querySelector('#imagen' + index).value = '';
        document.querySelector('#imagen' + index).previousElementSibling.querySelector('.plus-icon').style.display = 'block';
    }
</script>
@endpush
