<div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', optional($product)->name) }}" required>
</div>
<div class="mb-3">
    <label for="quantity" class="form-label">Cantidad</label>
    <input type="number" name="quantity" class="form-control" value="{{ old('quantity', optional($product)->quantity) }}" required>
</div>
<div class="mb-3">
    <label for="description" class="form-label">Descripción</label>
    <textarea name="description" class="form-control" required>{{ old('description', optional($product)->description) }}</textarea>
</div>
<div class="mb-3">
    <label for="price" class="form-label">Precio</label>
    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', optional($product)->price) }}" required>
</div>
<div class="mb-3">
    <label for="media_file" class="form-label">Foto</label>
    <input type="file" name="media_file" class="form-control" accept="image/*">
    @if(optional($product)->media_file)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $product->media_file) }}" alt="Foto actual" width="80">
        </div>
    @endif
</div>
<button type="submit" class="btn btn-primary">{{ $btnText }}</button>
<a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>