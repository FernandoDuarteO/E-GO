@extends('layouts.app')

@section('content')

<div class="profile-wrap" role="main" aria-labelledby="profileTitle">
  <div class="profile-header">
    <h1 id="profileTitle" class="profile-title">Mi Perfil</h1>

    <div class="profile-connected" role="status" aria-live="polite">
      <span class="conn-icon" aria-hidden="true">
        <svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <defs><linearGradient id="gConn" x1="0" x2="1" y1="0" y2="1"><stop offset="0" stop-color="#7b4be0"/><stop offset="1" stop-color="#a47cf7"/></linearGradient></defs>
          <circle cx="12" cy="12" r="10" fill="url(#gConn)"/>
          <path d="M12 11.2c1.3 0 2.4-1 2.4-2.3S13.3 6.6 12 6.6s-2.4 1-2.4 2.3S10.7 11.2 12 11.2z" fill="rgba(255,255,255,0.95)"/>
          <path d="M6.6 17.4c0-2.2 3-3.6 5.4-3.6s5.4 1.4 5.4 3.6v.6H6.6v-.6z" fill="rgba(255,255,255,0.9)"/>
          <path d="M17.6 13.1l-3.1 3.1-1.8-1.8" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        </svg>
      </span>

      <span class="conn-text">Conectado como:</span>
      <span class="conn-name">{{ $user->name ?? auth()->user()->name ?? 'Usuario' }}</span>
    </div>
  </div>

  <div class="profile-main">
    <!-- LEFT: Profile avatar/top uploader, spacer, then entrepreneurship image + uploader -->
    <aside class="left-card" aria-label="Avatar y logo">
      <!-- Profile avatar -->
      <div class="profile-avatar" aria-hidden="true">
        @if(isset($entrepreneur) && $entrepreneur->media_file)
          <img id="avatar-preview" src="{{ asset('storage/' . $entrepreneur->media_file) }}" alt="Avatar">
        @else
          <div id="avatar-preview" style="text-align:center; color:var(--muted); font-weight:800;">Sin imagen</div>
        @endif
      </div>

      <div class="caption">Tu imagen de perfil</div>
      <div class="note">Mantén tu foto actualizada (jpg, png). Tamaño máximo 4MB.</div>

      <div class="profile-uploader">
        <form id="profile-upload-form" action="{{ route('profile.combined.updateProfile') }}" method="POST" enctype="multipart/form-data" style="width:100%; display:flex; flex-direction:column; align-items:center;">
          @csrf
          <div class="file-label-row" style="position:relative;">
            <input id="media_file" type="file" name="media_file" class="file-control-hidden" accept="image/*" aria-label="Seleccionar imagen de perfil">
            <label for="media_file" class="file-icon" title="Seleccionar imagen de perfil" tabindex="0" role="button" aria-pressed="false">
              <svg width="20" height="20" viewBox="0 0 24 24" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 21H3V7h4l2-3h8l2 3h4v14z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                <circle cx="12" cy="13" r="3.5" stroke="currentColor" stroke-width="1.2"/>
              </svg>
            </label>
            <div id="media_file_name" class="file-name">Ninguno seleccionado</div>
          </div>

          <div style="margin-top:6px;">
            <button type="submit" class="btn-base btn-upload">Subir foto</button>
          </div>
        </form>
      </div>

      <!-- BIG spacer to separate profile area from entrepreneurship area (same left column) -->
      <div class="left-spacer" aria-hidden="true"></div>

      <!-- Entrepreneurship image & uploader (moved lower in left column) -->
      <div class="business-square" aria-hidden="true">
        @if(isset($entrepreneurship) && $entrepreneurship->media_file)
          <img id="logo-preview" src="{{ asset('storage/' . $entrepreneurship->media_file) }}" alt="Logo">
        @else
          <div id="logo-preview" style="text-align:center; color:var(--muted); font-weight:700;">Sin logo</div>
        @endif
      </div>

      <div class="caption">Imagen del perfil del emprendimiento</div>

      <div class="business-uploader">
        <form id="business-upload-form" action="{{ route('profile.combined.updateBusiness') }}" method="POST" enctype="multipart/form-data" style="width:100%; display:flex; flex-direction:column; align-items:center;">
          @csrf
          <div class="file-label-row" style="position:relative;">
            <input id="business_media_file" type="file" name="business_media_file" class="file-control-hidden" accept="image/*" aria-label="Seleccionar imagen del emprendimiento">
            <label for="business_media_file" class="file-icon" title="Seleccionar imagen del emprendimiento" tabindex="0" role="button" aria-pressed="false">
              <svg width="20" height="20" viewBox="0 0 24 24" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 21H3V7h4l2-3h8l2 3h4v14z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                <circle cx="12" cy="13" r="3.5" stroke="currentColor" stroke-width="1.2"/>
              </svg>
            </label>
            <div id="business_media_file_name" class="file-name">Ninguno seleccionado</div>
          </div>

          <div style="margin-top:6px;">
            <button type="submit" class="btn-base btn-upload">Subir foto</button>
          </div>
        </form>
      </div>
    </aside>

    <!-- RIGHT: forms (datos personales & datos del emprendimiento) -->
    <div class="form-card" aria-label="Formularios de perfil y emprendimiento">
      <div class="section-panel" id="panel-personal">
        <div>
          <div class="section-title">
            <span class="badge" aria-hidden="true">
              <!-- Updated icon: person/user outline for Datos personales -->
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M4 20c0-3.31 2.69-6 6-6h4c3.31 0 6 2.69 6 6" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
            Datos personales
          </div>
          <div class="section-desc">Completa tus datos para que los clientes te conozcan mejor</div>
        </div>

        <form action="{{ route('profile.combined.updateProfile') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="fields-grid" role="group" aria-label="Campos personales">
            <!-- Reordered & sized fields: Correo, Teléfono (small), Cédula, Edad, Sexo, Nacionalidad, País, Departamento, Municipio -->
            <div class="field">
              <label>Correo</label>
              <input class="control" type="email" name="email" value="{{ old('email', $entrepreneur->email ?? $user->email ?? '') }}">
              @error('email') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <!-- Make Teléfono small (not full) so there are 3 inputs per row -->
            <div class="field">
              <label>Teléfono</label>
              <input class="control" type="text" name="telephone" value="{{ old('telephone', $entrepreneur->telephone ?? '') }}">
              @error('telephone') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>Cédula</label>
              <input class="control" type="text" name="identification_card" value="{{ old('identification_card', $entrepreneur->identification_card ?? '') }}">
              @error('identification_card') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>Edad</label>
              <input class="control" type="text" name="age" value="{{ old('age', $entrepreneur->age ?? '') }}">
              @error('age') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>Sexo</label>
              <input class="control" type="text" name="sex" value="{{ old('sex', $entrepreneur->sex ?? '') }}">
              @error('sex') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>Nacionalidad</label>
              <input class="control" type="text" name="nationality" value="{{ old('nationality', $entrepreneur->nationality ?? '') }}">
              @error('nationality') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>País</label>
              <input class="control" type="text" name="country" value="{{ old('country', $entrepreneur->country ?? '') }}">
              @error('country') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>Departamento</label>
              <input class="control" type="text" name="department" value="{{ old('department', $entrepreneur->department ?? '') }}">
              @error('department') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <!-- Moved Municipio to align with País/Departamento so each row has up to 3 inputs -->
            <div class="field">
              <label>Municipio</label>
              <input class="control" type="text" name="municipality" value="{{ old('municipality', $entrepreneur->municipality ?? '') }}">
              @error('municipality') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

          </div>

          <div class="divider"></div>

          <div class="actions">
            <!-- CORREGIDO: cancelar ahora apunta a profile.combined.show para comportarse igual que el otro -->
            <a href="{{ route('profile.combined.show') }}" class="btn-base btn-cancel" style="text-decoration:none;">Cancelar</a>
            <button type="submit" class="btn-base btn-save">Guardar</button>
          </div>
        </form>
      </div>

      <div class="section-panel" id="panel-business">
        <div>
          <div class="section-title">
            <span class="badge" aria-hidden="true">
              <!-- Updated icon: storefront / briefcase outline for Datos del emprendimiento -->
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                <rect x="3" y="7" width="18" height="11" rx="2" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M3 7l2-3h14l2 3" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
            Datos del emprendimiento
          </div>
          <div class="section-desc">Información pública del negocio</div>
        </div>

        <form action="{{ route('profile.combined.updateBusiness') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="fields-grid">
            <!-- Reordered business fields with balanced rows (3 inputs per row where possible):
                 Row 1: Nombre del Emprendimiento | Tipo | Teléfono
                 Row 2: Descripción (full)
                 Row 3: Email | Dirección | Departamento
                 Row 4: Años experiencia (kept in its place) -->
            <div class="field">
              <label>Nombre del Emprendimiento</label>
              <input class="control" type="text" name="business_name" value="{{ old('business_name', $entrepreneurship->business_name ?? '') }}">
              @error('business_name') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>Tipo</label>
              <input class="control" type="text" name="business_type" value="{{ old('business_type', $entrepreneurship->business_type ?? '') }}">
              @error('business_type') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>Teléfono</label>
              <input class="control" type="text" name="telephone" value="{{ old('telephone', $entrepreneurship->telephone ?? '') }}">
              @error('telephone') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field full">
              <label>Descripción</label>
              <textarea class="control" name="description">{{ old('description', $entrepreneurship->description ?? '') }}</textarea>
              @error('description') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <!-- Email reduced to a normal-sized field so it shares row space -->
            <div class="field">
              <label>Email</label>
              <input class="control" type="email" name="email" value="{{ old('email', $entrepreneurship->email ?? '') }}">
              @error('email') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>Dirección</label>
              <input class="control" type="text" name="address" value="{{ old('address', $entrepreneurship->address ?? '') }}">
              @error('address') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>Departamento</label>
              <input class="control" type="text" name="department" value="{{ old('department', $entrepreneurship->department ?? '') }}">
              @error('department') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>Años experiencia</label>
              <input class="control" type="number" name="years_experience" value="{{ old('years_experience', $entrepreneurship->years_experience ?? 0) }}">
              @error('years_experience') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

          </div>

          <div style="height:12px;"></div>

          <div class="actions">
            <a href="{{ route('profile.combined.show') }}" class="btn-base btn-cancel" style="text-decoration:none;">Cancelar</a>
            <button type="submit" class="btn-base btn-save">Guardar emprendimiento</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script src="{{ asset('js/profile-combined.js') }}" defer></script>
@endpush
@endsection