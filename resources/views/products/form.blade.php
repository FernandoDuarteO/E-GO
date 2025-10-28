@props(['products' => null, 'categories' => [], 'btnText' => 'Guardar'])

@php
    // Colección segura de imágenes existentes (si hay producto)
    $imagesCollection = collect();
    if (isset($products) && is_object($products) && method_exists($products, 'images')) {
        if ($products->relationLoaded('images')) {
            $imagesCollection = $products->images->sortBy('order')->values();
        } else {
            $imagesCollection = $products->images()->orderBy('order')->get()->values();
        }
    }
@endphp

<div class="form-inner">
    <div class="row">
        <!-- IMAGENES: 4 slots (sin tocar tamaño) -->
        <div class="col-12 mb-3">
            <label class="form-label fw-semibold d-block mb-2">Imágenes del producto</label>

            <div class="image-slots" id="image-slots-container">
                @for ($slot = 0; $slot < 4; $slot++)
                    @php $img = $imagesCollection->get($slot); @endphp

                    <div class="image-slot {{ $img ? 'filled' : 'empty' }}" data-slot="{{ $slot }}" tabindex="0" role="button" aria-label="Slot de imagen {{ $slot + 1 }}">
                        @if($img)
                            <img src="{{ Storage::url($img->file_path) }}" alt="Imagen {{ $slot + 1 }}" data-existing-id="{{ $img->id }}">
                            <div class="slot-actions">
                                <button type="button" class="slot-btn slot-replace-btn" data-image-id="{{ $img->id }}" title="Reemplazar">✎</button>
                                <button type="button" class="slot-btn slot-delete-btn" data-image-id="{{ $img->id }}" title="Eliminar">🗑</button>
                            </div>
                            <input type="file" accept="image/*" class="d-none replace-input" name="replace_image[{{ $img->id }}]" data-image-id="{{ $img->id }}">
                            <input type="checkbox" name="delete_images[]" value="{{ $img->id }}" class="d-none delete-checkbox" id="delete_img_{{ $img->id }}">
                            <div class="slot-replaced-badge d-none">Reemplazada</div>
                        @else
                            <span class="plus">+</span>
                            <input type="file" accept="image/*" class="d-none new-input" name="media_files[]" data-slot="{{ $slot }}">
                        @endif
                    </div>
                @endfor
            </div>
        </div>

        <!-- ROW principal: descripción a la izquierda y campos a la derecha -->
        <div class="col-12">
            <div class="inputs-row">
                <!-- IZQUIERDA: Descripción -->
                <div class="inputs-left">
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Descripción</label>
                        <textarea name="description" id="description" class="form-control form-description custom rounded-4 shadow-sm" rows="7" required>{{ old('description', optional($products)->description) }}</textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- DERECHA: Nombre + Categoría (lado a lado), Cantidad + Precio (fila siguiente) -->
                <div class="inputs-right">
                    <div class="right-grid">
                        <div>
                            <label for="name" class="form-label fw-semibold">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control custom rounded-4 shadow-sm" value="{{ old('name', optional($products)->name) }}" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div>
                            <label for="category_id" class="form-label fw-semibold">Categoría</label>
                            <select name="category_id" id="category_id" class="form-select custom rounded-4 shadow-sm">
                                <option value="">Selecciona una categoría</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', optional($products)->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->type }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div>
                            <label for="quantity" class="form-label fw-semibold">Cantidad</label>
                            <input type="number" name="quantity" id="quantity" class="form-control custom rounded-4 shadow-sm" value="{{ old('quantity', optional($products)->quantity) }}" required>
                            @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div>
                            <label for="price" class="form-label fw-semibold">Precio</label>
                            <input type="number" step="0.01" name="price" id="price" class="form-control custom rounded-4 shadow-sm" value="{{ old('price', optional($products)->price) }}" required>
                            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="col-12">
            <div class="form-actions">
                <button type="submit" class="btn btn-primary-custom">{{ $btnText }}</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary-custom">Cancelar</a>
            </div>
        </div>
    </div>
</div>

{{-- JS: gestión de previews / inputs (preserva file inputs) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const slotContainers = document.querySelectorAll('.image-slot');

    slotContainers.forEach(slot => {
        slot.addEventListener('click', function (e) {
            if (e.target.closest('.slot-actions')) return;

            const newInput = slot.querySelector('.new-input');
            if (newInput) { newInput.click(); return; }

            const replaceInput = slot.querySelector('.replace-input');
            if (replaceInput) { replaceInput.click(); return; }
        });
    });

    document.addEventListener('change', function (e) {
        // Nuevo archivo en slot vacío
        if (e.target.classList.contains('new-input')) {
            const input = e.target; // mantener referencia para preservar file
            const file = input.files[0];
            if (!file || !file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = function (ev) {
                const slot = input.closest('.image-slot');
                if (!slot) return;

                // mantener el input para que el archivo sea enviado con el form
                slot.innerHTML = '';

                const img = document.createElement('img');
                img.src = ev.target.result;
                img.alt = 'Preview';
                slot.appendChild(img);

                const actions = document.createElement('div');
                actions.className = 'slot-actions';
                actions.innerHTML = `
                    <button type="button" class="slot-btn slot-replace-btn">✎</button>
                    <button type="button" class="slot-btn slot-delete-btn">🗑</button>
                `;
                slot.appendChild(actions);

                const badge = document.createElement('div');
                badge.className = 'slot-replaced-badge d-none';
                badge.textContent = 'Nuevo';
                slot.appendChild(badge);

                input.classList.add('d-none');
                slot.appendChild(input);
                slot.classList.remove('empty');
                slot.classList.add('filled');
            };
            reader.readAsDataURL(file);
            return;
        }

        // Reemplazo de imagen existente
        if (e.target.classList.contains('replace-input')) {
            const input = e.target;
            const file = input.files[0];
            if (!file || !file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = function (ev) {
                const slot = input.closest('.image-slot');
                if (!slot) return;
                const img = slot.querySelector('img');
                if (img) img.src = ev.target.result;
                const badge = slot.querySelector('.slot-replaced-badge');
                if (badge) badge.classList.remove('d-none');
                const delCheckbox = slot.querySelector('.delete-checkbox');
                if (delCheckbox) delCheckbox.checked = false;
            };
            reader.readAsDataURL(file);
            return;
        }
    });

    document.addEventListener('click', function (e) {
        // Replace button
        if (e.target.classList.contains('slot-replace-btn')) {
            const slot = e.target.closest('.image-slot');
            if (!slot) return;
            const replaceInput = slot.querySelector('.replace-input');
            const newInput = slot.querySelector('.new-input');
            if (replaceInput) replaceInput.click();
            else if (newInput) newInput.click();
            else {
                const anyInput = slot.querySelector('input[type="file"]');
                if (anyInput) anyInput.click();
            }
            return;
        }

        // Delete button
        if (e.target.classList.contains('slot-delete-btn')) {
            const slot = e.target.closest('.image-slot');
            if (!slot) return;

            const delCheckbox = slot.querySelector('.delete-checkbox');
            if (delCheckbox) {
                delCheckbox.checked = !delCheckbox.checked;
                slot.style.opacity = delCheckbox.checked ? '0.45' : '1';
                return;
            }

            // nueva imagen: limpiar input y restaurar estado "+"
            const fileInput = slot.querySelector('input[type="file"]');
            if (fileInput) {
                try { fileInput.value = ''; } catch (err) {}
            }
            slot.innerHTML = '<span class="plus">+</span><input type="file" accept="image/*" class="d-none new-input" name="media_files[]">';
            slot.classList.remove('filled');
            slot.classList.add('empty');
        }
    });

    // Accessibility: activar con Enter/Space
    document.addEventListener('keydown', function (e) {
        if ((e.key === 'Enter' || e.key === ' ') && document.activeElement && document.activeElement.classList.contains('image-slot')) {
            e.preventDefault();
            document.activeElement.click();
        }
    });
});
</script>