<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="row">
    <!-- Descripción a la izquierda -->
    <div class="col-md-6 mb-3">
        <label for="description" class="form-label fw-semibold">Descripción</label>
        <textarea name="description" id="description" class="form-control rounded-4 shadow-sm" rows="7" required>{{ old('description', optional($products)->description) }}</textarea>
    </div>
    <!-- Campos a la derecha -->
    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Nombre</label>
            <input type="text" name="name" id="name" class="form-control rounded-4 shadow-sm" value="{{ old('name', optional($products)->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label fw-semibold">Cantidad</label>
            <input type="number" name="quantity" id="quantity" class="form-control rounded-4 shadow-sm" value="{{ old('quantity', optional($products)->quantity) }}" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label fw-semibold">Precio</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control rounded-4 shadow-sm" value="{{ old('price', optional($products)->price) }}" required>
        </div>
        <div class="mb-3">
            <label for="media_file" class="form-label fw-semibold">Foto</label>
            <input type="file" name="media_file" id="media_file" class="form-control rounded-4 shadow-sm" accept="image/*">
            @if(optional($products)->media_file)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $products->media_file) }}" alt="Foto actual" width="80" class="rounded shadow-sm">
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label fw-semibold">Categoría</label>
            <select name="category_id" id="category_id" class="form-select rounded-4 shadow-sm" required>
                <option value="">Selecciona una categoría</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', optional($products)->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->type }}
                </option>
                @endforeach
            </select>
            @error('category_id')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
<div class="d-flex justify-content-center gap-4 mt-4">
    <button type="submit" class="btn px-5 py-2" style="background: #7766C6; border-color: #7766C6; color: #fff; font-size: 1.1rem;">{{ $btnText }}</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary px-5 py-2" style="font-size: 1.1rem;">Cancelar</a>
</div>
