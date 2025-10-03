<div class="row">
    <div class="col-md-6">
        <div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
</div>
        <div class="form-group">
            <label for="age">Edad</label>
            <input type="text" name="age" class="form-control" maxlength="3" value="{{ old('age', optional($entrepreneur)->age) }}" required>
        </div>
        <div class="form-group">
            <label for="sex">Sexo</label>
            <input type="text" name="sex" class="form-control" maxlength="10" value="{{ old('sex', optional($entrepreneur)->sex) }}" required>
        </div>
        <div class="form-group">
            <label for="identification_card">Cédula</label>
            <input type="text" name="identification_card" class="form-control" maxlength="20" value="{{ old('identification_card', optional($entrepreneur)->identification_card) }}" required>
        </div>
        <div class="form-group">
            <label for="telephone">Teléfono</label>
            <input type="text" name="telephone" class="form-control" maxlength="8" value="{{ old('telephone', optional($entrepreneur)->telephone) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', optional($entrepreneur)->email) }}" required>
        </div>
        <div class="form-group">
            <label for="country">País</label>
            <input type="text" name="country" class="form-control" value="{{ old('country', optional($entrepreneur)->country) }}" required>
        </div>
        <div class="form-group">
            <label for="nationality">Nacionalidad</label>
            <input type="text" name="nationality" class="form-control" value="{{ old('nationality', optional($entrepreneur)->nationality) }}" required>
        </div>
        <div class="form-group">
            <label for="municipality">Municipio</label>
            <input type="text" name="municipality" class="form-control" value="{{ old('municipality', optional($entrepreneur)->municipality) }}" required>
        </div>
        <div class="form-group">
            <label for="department">Departamento</label>
            <input type="text" name="department" class="form-control" value="{{ old('department', optional($entrepreneur)->department) }}" required>
        </div>
        <div class="form-group">
            <label for="media_file">Foto de perfil</label>
            <input type="file" name="media_file" class="form-control">
            @if(isset($entrepreneur) && $entrepreneur->media_file)
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$entrepreneur->media_file) }}" alt="Foto de perfil" width="120">
                </div>
            @endif
        </div>
    </div>
</div>
