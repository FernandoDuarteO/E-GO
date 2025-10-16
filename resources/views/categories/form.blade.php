<div class="mb-3">
    <label for="type" class="form-label fw-semibold">Nombre de la categoría</label>
    <input type="text" name="type" id="type" class="form-control rounded-4 shadow-sm"
           value="{{ old('type', optional($categories)->type) }}" required>
    @error('type')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label fw-semibold">Descripción</label>
    <textarea name="description" id="description" class="form-control rounded-4 shadow-sm" rows="4">{{ old('description', optional($categories)->description) }}</textarea>
    @error('description')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="d-flex justify-content-center gap-4 mt-4">
    <button type="submit" class="btn px-5 py-2" style="background: #7766C6; border-color: #7766C6; color: #fff; font-size: 1.1rem;">{{ $btnText }}</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary px-5 py-2" style="font-size: 1.1rem;">Cancelar</a>
</div>
