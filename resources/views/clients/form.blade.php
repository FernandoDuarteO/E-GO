<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
        </div>
        <div class="form-group">
            <label for="age">Edad</label>
            <input type="text" name="age" class="form-control" maxlength="3" value="{{ old('age', optional($client)->age) }}" required>
        </div>
        <div class="form-group">
            <label for="sex">Sexo</label>
            <select name="sex" id="sex" class="form-control" required>
                <option value="">Selecciona una opción</option>
                <option value="Femenino" {{ old('sex', optional($client)->sex) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="Masculino" {{ old('sex', optional($client)->sex) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
            </select>
        </div>
        <div class="form-group">
            <label for="identification_card">Cédula</label>
            <input type="text" name="identification_card" class="form-control" maxlength="20" value="{{ old('identification_card', optional($client)->identification_card) }}" required>
        </div>
        <div class="form-group">
            <label for="telephone">Teléfono</label>
            <input type="text" name="telephone" class="form-control" maxlength="8" value="{{ old('telephone', optional($client)->telephone) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', optional($client)->email) }}" required>
        </div>
        <div class="form-group">
            <label for="country">País</label>
            <select name="country" id="country" class="form-control" required>
                <option value="">Selecciona un país</option>
                <option value="Nicaragua" {{ old('country', optional($client)->country) == 'Nicaragua' ? 'selected' : '' }}>Nicaragua</option>
                <option value="Costa Rica" {{ old('country', optional($client)->country) == 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>
                <option value="Honduras" {{ old('country', optional($client)->country) == 'Honduras' ? 'selected' : '' }}>Honduras</option>
                <option value="El Salvador" {{ old('country', optional($client)->country) == 'El Salvador' ? 'selected' : '' }}>El Salvador</option>
                <option value="Guatemala" {{ old('country', optional($client)->country) == 'Guatemala' ? 'selected' : '' }}>Guatemala</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nationality">Nacionalidad</label>
            <select name="nationality" id="nationality" class="form-control" required>
                <option value="">Selecciona una nacionalidad</option>
                <option value="Nicaragüense" {{ old('nationality', optional($client)->nationality) == 'Nicaragüense' ? 'selected' : '' }}>Nicaragüense</option>
                <option value="Costarricense" {{ old('nationality', optional($client)->nationality) == 'Costarricense' ? 'selected' : '' }}>Costarricense</option>
                <option value="Hondureño/a" {{ old('nationality', optional($client)->nationality) == 'Hondureño/a' ? 'selected' : '' }}>Hondureño/a</option>
                <option value="Salvadoreño/a" {{ old('nationality', optional($client)->nationality) == 'Salvadoreño/a' ? 'selected' : '' }}>Salvadoreño/a</option>
                <option value="Guatemalteco/a" {{ old('nationality', optional($client)->nationality) == 'Guatemalteco/a' ? 'selected' : '' }}>Guatemalteco/a</option>
            </select>
        </div>
        <div class="form-group">
            <label for="municipality">Municipio</label>
            <select name="municipality" id="municipality" class="form-control" required>
                <option value="">Selecciona un municipio</option>
                <option value="Condega" {{ old('municipality', optional($client)->municipality) == 'Condega' ? 'selected' : '' }}>Condega</option>
                <option value="Estelí" {{ old('municipality', optional($client)->municipality) == 'Estelí' ? 'selected' : '' }}>Estelí</option>
                <option value="San Juan de Limay" {{ old('municipality', optional($client)->municipality) == 'San Juan de Limay' ? 'selected' : '' }}>San Juan de Limay</option>
                <option value="Managua" {{ old('municipality', optional($client)->municipality) == 'Managua' ? 'selected' : '' }}>Managua</option>
                <option value="Mateare" {{ old('municipality', optional($client)->municipality) == 'Mateare' ? 'selected' : '' }}>Mateare</option>
                <option value="Achuapa" {{ old('municipality', optional($client)->municipality) == 'Achuapa' ? 'selected' : '' }}>Achuapa</option>
                <option value="El Sauce" {{ old('municipality', optional($client)->municipality) == 'El Sauce' ? 'selected' : '' }}>El Sauce</option>
            </select>
        </div>
        <div class="form-group">
            <label for="department">Departamento</label>
            <select name="department" id="department" class="form-control" required>
                <option value="">Selecciona un departamento</option>
                <option value="Estelí" {{ old('department', optional($client)->department) == 'Estelí' ? 'selected' : '' }}>Estelí</option>
                <option value="Managua" {{ old('department', optional($client)->department) == 'Managua' ? 'selected' : '' }}>Managua</option>
                <option value="León" {{ old('department', optional($client)->department) == 'León' ? 'selected' : '' }}>León</option>
            </select>
        </div>
        <div class="form-group">
            <label for="media_file">Foto de perfil</label>
            <input type="file" name="media_file" class="form-control">
            @if(isset($client) && $client->media_file)
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$client->media_file) }}" alt="Foto de perfil" width="120">
                </div>
            @endif
        </div>
    </div>
</div>
