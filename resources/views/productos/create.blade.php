@extends('layouts.app')

@section('content')
<div class="p-4 rounded" style="background:#dedffc;">
    <h2 class="fw-bold mb-4">Agregar producto</h2>

    <form>
        <div class="row">
            <!-- Sección izquierda -->
            <div class="col-md-8">
                <!-- Cuadros de imágenes -->
                <div class="d-flex justify-content-between mb-3 flex-wrap">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="img-upload-box text-center mb-3">
                            <label for="imagen{{ $i }}" class="upload-label">
                                <span class="plus-icon">+</span>
                                <img id="preview{{ $i }}" class="preview-img d-none" alt="Preview">
                            </label>
                            <input type="file" id="imagen{{ $i }}" class="d-none" 
                                   accept="image/*" onchange="previewImage(event, {{ $i }})">
                        </div>
                    @endfor
                </div>

                <!-- Descripción -->
                <div class="mb-3">
                    <textarea class="form-control" rows="4" maxlength="2200"
                              placeholder="Editar descripción..."></textarea>
                    <small class="text-muted">0/2200</small>
                </div>
            </div>

            <!-- Sección derecha -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label fw-bold">Precio:</label>
                    <input type="number" class="form-control" value="92">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Disponible:</label>
                    <select class="form-control">
                        <option>Disponible</option>
                        <option selected>Agotado</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Cantidad:</label>
                    <input type="number" class="form-control" value="6">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Tamaño:</label>
                    <input type="text" class="form-control" value="Mediano">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Tipo:</label>
                    <input type="text" class="form-control" value="Accesorio">
                </div>
            </div>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary me-2 px-4">Guardar cambios</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary px-4">Cancelar</a>
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
            input.previousElementSibling.querySelector('.plus-icon').style.display = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    }
</script>
@endpush