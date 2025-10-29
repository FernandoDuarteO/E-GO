   @extends('layouts.app')

@section('content')
<style>
  :root{
    --page-bg: #f4f6fb;
    --canvas: #ffffff;
    --accent: #6f4bd1;
    --accent-2: #8b6cf7;
    --muted: #6b6f76;
    --input-bg: #f3f6ff;
    --input-border: rgba(88,72,144,0.08);
    --card-shadow: 0 18px 40px rgba(60,50,120,0.05);
    --radius-lg: 12px;
  }

  .profile-wrap{
    max-width:1200px;
    margin:36px auto;
    padding:28px;
    background:linear-gradient(180deg,#fbfbff,var(--page-bg));
  }

  .profile-header{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:18px;
  }
  .profile-title{
    font-size:34px;
    font-weight:800;
    color:var(--accent);
    margin:0;
  }
  .profile-connected{
    margin-left:auto;
    color:var(--muted);
    font-weight:700;
    font-size:.95rem;
  }

  .profile-main{
    display:grid;
    grid-template-columns: 360px 1fr;
    gap:26px;
    align-items:stretch;
  }

  .left-card{
    background:var(--canvas);
    border-radius:var(--radius-lg);
    padding:18px;
    box-shadow:var(--card-shadow);
    border:1px solid rgba(111,75,209,0.02);
    display:flex;
    flex-direction:column;
    gap:16px;
    align-items:center;
    height:100%;
  }

  .square{
    width:240px;
    height:240px;
    border-radius:14px;
    background: linear-gradient(180deg,#faf9ff,#f4f2ff);
    border:6px solid rgba(111,75,209,0.03);
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden;
    padding:6px;
    box-shadow: 0 14px 36px rgba(111,75,209,0.04);
  }
  .square img{
    width:110%;
    height:110%;
    object-fit:cover;
    object-position:center;
    display:block;
    border-radius:8px;
  }

  .caption { font-weight:700; color:var(--muted); text-align:center; }
  .note { color:#9aa0a8; text-align:center; font-size:0.92rem; }

  .file-row{ width:100%; display:flex; gap:8px; align-items:center; justify-content:center; flex-wrap:wrap; }
  .file-input{ flex:1; max-width:260px; }
  input[type="file"].file-control{
    width:100%;
    padding:9px 10px;
    border-radius:8px;
    border:1px solid var(--input-border);
    background:#fff;
    cursor:pointer;
  }

  .btn-upload {
    padding:10px 20px;
    border-radius:999px;
    background: linear-gradient(90deg,var(--accent), var(--accent-2));
    color:#fff;
    border:0;
    font-weight:800;
    cursor:pointer;
    box-shadow: 0 10px 30px rgba(111,75,209,0.12);
  }
  .btn-upload:hover{ transform: translateY(-3px); }

  .form-card{
    background:var(--canvas);
    border-radius:var(--radius-lg);
    padding:20px;
    box-shadow:var(--card-shadow);
    border:1px solid rgba(111,75,209,0.02);
  }

  .section-title{ font-size:1rem; font-weight:800; color:#222; margin:0 0 6px 0; }
  .section-desc{ color:var(--muted); margin-bottom:12px; font-weight:600; }

  /* Grid: 3 columns layout for inputs */
  .fields-grid{ display:grid; grid-template-columns: repeat(3, 1fr); gap:14px 18px; }

  .field{ display:flex; flex-direction:column; }
  .field label{ font-size:.9rem; color:var(--muted); margin-bottom:8px; font-weight:700; }

  .control{ padding:12px 14px; border-radius:12px; border:1px solid var(--input-border); background:var(--input-bg); font-size:.95rem; color:#222; box-shadow:0 10px 24px rgba(88,72,144,0.04); }
  textarea.control{ min-height:110px; resize:vertical; }

  .full{ grid-column: 1 / -1; }

  .divider{ height:1px; background: linear-gradient(90deg, rgba(111,75,209,0.03), rgba(111,75,209,0.01)); margin:16px 0; border-radius:2px; }

  .actions{ display:flex; gap:12px; justify-content:flex-end; margin-top:18px; align-items:center; }
  .btn-save{ padding:10px 20px; border-radius:999px; background: linear-gradient(90deg,var(--accent-2), var(--accent)); color:#fff; border:0; font-weight:800; cursor:pointer; }
  .btn-cancel{ background:transparent; color:var(--accent); border:1px solid rgba(111,75,209,0.08); padding:8px 14px; border-radius:10px; font-weight:700; }

  @media (max-width: 980px){
    .profile-main{ grid-template-columns: 1fr; }
    .fields-grid{ grid-template-columns: 1fr; }
    .square{ width:180px; height:180px; }
  }

  .profile-uploader { margin-top: 12px; display:flex; flex-direction:column; align-items:center; gap:8px; width:100%; }
  .business-uploader { margin-top: 18px; display:flex; flex-direction:column; align-items:center; gap:8px; width:100%; }
</style>

<div class="profile-wrap" role="main" aria-labelledby="profileTitle">
  <div class="profile-header">
    <h1 id="profileTitle" class="profile-title">Mi Perfil</h1>
    <div class="profile-connected">Conectado como: <strong style="color:var(--accent); margin-left:6px;">{{ $user->name ?? auth()->user()->name ?? 'Usuario' }}</strong></div>
  </div>

  <div class="profile-main">
    <!-- LEFT: avatar + uploaders -->
    <aside class="left-card" aria-label="Avatar y logo">
      {{-- Avatar visual --}}
      <div class="square" aria-hidden="true">
        @if(isset($entrepreneur) && $entrepreneur->media_file)
          <img src="{{ asset('storage/' . $entrepreneur->media_file) }}" alt="Avatar">
        @else
          <div style="text-align:center; color:var(--muted); font-weight:800;">Sin imagen</div>
        @endif
      </div>

      <div class="caption">Tu imagen de perfil</div>
      <div class="note">Mantén tu foto actualizada (jpg, png). Tamaño máximo 4MB.</div>

      {{-- PROFILE uploader --}}
      <div class="profile-uploader">
        <form action="{{ route('profile.combined.updateProfile') }}" method="POST" enctype="multipart/form-data" style="width:100%; display:flex; flex-direction:column; align-items:center;">
          @csrf
          <div class="file-input">
            <input type="file" name="media_file" class="file-control" accept="image/*" aria-label="Seleccionar imagen de perfil">
          </div>
          <div>
            <button type="submit" class="btn-upload">Subir foto</button>
          </div>
        </form>
      </div>

      <hr style="width:60%; border:none; border-top:1px solid rgba(0,0,0,0.04); margin:8px 0;">

      {{-- Business visual --}}
      <div class="square" aria-hidden="true">
        @if(isset($entrepreneurship) && $entrepreneurship->media_file)
          <img src="{{ asset('storage/' . $entrepreneurship->media_file) }}" alt="Logo">
        @else
          <div style="text-align:center; color:var(--muted); font-weight:700;">Sin logo</div>
        @endif
      </div>

      <div class="caption">Imagen del perfil del emprendimiento</div>
      <div class="note">Mantén el logo/imagen del negocio actualizado (jpg, png). Tamaño máximo 4MB.</div>

      {{-- BUSINESS uploader --}}
      <div class="business-uploader">
        <form action="{{ route('profile.combined.updateBusiness') }}" method="POST" enctype="multipart/form-data" style="width:100%; display:flex; flex-direction:column; align-items:center;">
          @csrf
          <div class="file-input">
            <input type="file" name="business_media_file" class="file-control" accept="image/*" aria-label="Seleccionar imagen del emprendimiento">
          </div>
          <div>
            <button type="submit" class="btn-upload">Subir imagen del emprendimiento</button>
          </div>
        </form>
      </div>
    </aside>

    <!-- RIGHT: forms -->
    <div class="form-card" aria-label="Formularios de perfil y emprendimiento">
      {{-- Datos personales --}}
      <div style="margin-bottom:18px;">
        <div class="section-title">Datos personales</div>
        <div class="section-desc">Completa tus datos para que los clientes te conozcan mejor</div>

        <form action="{{ route('profile.combined.updateProfile') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="fields-grid" role="group" aria-label="Campos personales">
            <div class="field">
              <label>Edad</label>
              <input class="control" type="text" name="age" value="{{ old('age', $entrepreneur->age ?? '') }}">
              @error('age') <div style="color:#c33">{{ $message }}</div> @enderror
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
              <label>Municipio</label>
              <input class="control" type="text" name="municipality" value="{{ old('municipality', $entrepreneur->municipality ?? '') }}">
              @error('municipality') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>Correo</label>
              <input class="control" type="email" name="email" value="{{ old('email', $entrepreneur->email ?? $user->email ?? '') }}">
              @error('email') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>Cédula</label>
              <input class="control" type="text" name="identification_card" value="{{ old('identification_card', $entrepreneur->identification_card ?? '') }}">
              @error('identification_card') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field full">
              <label>Teléfono</label>
              <input class="control" type="text" name="telephone" value="{{ old('telephone', $entrepreneur->telephone ?? '') }}">
              @error('telephone') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="divider"></div>

          <div class="actions">
            <a href="{{ route('profile.edit') }}" class="btn-cancel" style="text-decoration:none;">Cancelar</a>
            <button type="submit" class="btn-save">Guardar</button>
          </div>
        </form>
      </div>

      {{-- Datos emprendimiento --}}
      <div>
        <div class="section-title">Datos del emprendimiento</div>
        <div class="section-desc">Información pública del negocio</div>

        <form action="{{ route('profile.combined.updateBusiness') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="fields-grid">
            <div class="field full">
              <label>Descripción</label>
              <textarea class="control" name="description">{{ old('description', $entrepreneurship->description ?? '') }}</textarea>
              @error('description') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <!-- Row 1 -->
            <div class="field">
              <label>Teléfono</label>
              <input class="control" type="text" name="telephone" value="{{ old('telephone', $entrepreneurship->telephone ?? '') }}">
              @error('telephone') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>Tipo</label>
              <input class="control" type="text" name="business_type" value="{{ old('business_type', $entrepreneurship->business_type ?? '') }}">
              @error('business_type') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>Dirección</label>
              <input class="control" type="text" name="address" value="{{ old('address', $entrepreneurship->address ?? '') }}">
              @error('address') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <!-- Row 2 -->
            <div class="field">
              <label>Departamento</label>
              <input class="control" type="text" name="department" value="{{ old('department', $entrepreneurship->department ?? '') }}">
              @error('department') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>Nombre del Emprendimiento</label>
              <input class="control" type="text" name="business_name" value="{{ old('business_name', $entrepreneurship->business_name ?? '') }}">
              @error('business_name') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <label>Años experiencia</label>
              <input class="control" type="number" name="years_experience" value="{{ old('years_experience', $entrepreneurship->years_experience ?? 0) }}">
              @error('years_experience') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

            <!-- Row 3 -->
            <div class="field full">
              <label>Email</label>
              <input class="control" type="email" name="email" value="{{ old('email', $entrepreneurship->email ?? '') }}">
              @error('email') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>
          </div>

          <div style="height:12px;"></div>

          <div class="actions">
            <a href="{{ route('profile.combined.show') }}" class="btn-cancel" style="text-decoration:none;">Cancelar</a>
            <button type="submit" class="btn-save">Guardar emprendimiento</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection