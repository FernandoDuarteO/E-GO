@extends('layouts.app')

@section('content')
<style>
  :root{
    --page-bg: #f4f6fb;
    --canvas: #ffffff;

    --purple-1: #6f4bd1;
    --purple-2: #8b6cf7;

    --hover-yellow-1: #f4c34a;
    --hover-yellow-2: #f2b93a;

    --accent: var(--purple-1);
    --accent-2: var(--purple-2);

    --muted: #6b6f76;
    --input-bg: #f7f8ff;
    --input-border: rgba(88,72,144,0.08);
    --card-shadow: 0 18px 40px rgba(60,50,120,0.05);
    --radius-lg: 12px;
  }

  body { -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale; }

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
    display:inline-flex;
    align-items:center;
    gap:12px;
    background: linear-gradient(90deg, rgba(111,75,209,0.04), rgba(139,108,247,0.02));
    padding:10px 14px;
    border-radius:12px;
    border-left:6px solid var(--purple-1);
    box-shadow: 0 8px 22px rgba(111,75,209,0.04);
    font-weight:700;
    color:var(--muted);
    font-size:.95rem;
  }

  .profile-connected .conn-icon {
    display:inline-flex;
    width:36px;
    height:36px;
    align-items:center;
    justify-content:center;
    border-radius:8px;
    background: linear-gradient(90deg,var(--purple-1),var(--purple-2));
    color:#fff;
    box-shadow: 0 6px 18px rgba(111,75,209,0.12);
    flex: 0 0 36px;
  }

  .profile-connected .conn-text { color:var(--muted); font-weight:700; }
  .profile-connected .conn-name { color: var(--purple-1); font-weight:900; margin-left:6px; }

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
    gap:0; /* spacing handled manually below */
    align-items:center;
    height:100%;
  }

  /* Profile avatar block (top) */
  .profile-avatar {
    width:240px;
    height:240px;
    border-radius:24px;
    background: linear-gradient(180deg,#faf9ff,#f4f2ff);
    border:6px solid rgba(111,75,209,0.03);
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden;
    padding:6px;
    box-shadow: 0 14px 36px rgba(111,75,209,0.04);
    margin-top:8px;
  }
  .profile-avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
    object-position:center;
    display:block;
    border-radius:18px;
  }

  .caption { font-weight:700; color:var(--muted); text-align:center; margin-top:12px; margin-bottom:8px; }
  .note { color:#9aa0a8; text-align:center; font-size:0.92rem; }

  .file-control-hidden{
    position:absolute !important;
    width:1px;height:1px;
    padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0;
  }

  .btn-base {
    padding:10px 20px;
    border-radius:12px;
    font-weight:800;
    cursor:pointer;
    border:0;
    transition: background .15s ease, color .12s ease, transform .12s ease, box-shadow .12s ease;
    box-shadow: 0 10px 30px rgba(111,75,209,0.12);
    text-align:center;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    user-select:none;
  }

  .btn-upload,
  .btn-save {
    background: linear-gradient(90deg,var(--purple-1), var(--purple-2));
    color: #fff;
    box-shadow: 0 10px 30px rgba(111,75,209,0.12);
    border-radius: 999px;
  }

  .btn-upload:hover,
  .btn-upload:focus,
  .btn-save:hover,
  .btn-save:focus {
    background: linear-gradient(90deg, var(--hover-yellow-1), var(--hover-yellow-2));
    color: #111;
    transform: translateY(-3px);
    box-shadow: 0 14px 36px rgba(0,0,0,0.12);
    outline: none;
  }

  .file-icon {
    display:inline-flex;
    align-items:center;
    justify-content:center;
    width:44px;
    height:44px;
    border-radius:10px;
    background: linear-gradient(90deg,var(--purple-1), var(--purple-2));
    color:#fff;
    border:2px solid rgba(111,75,209,0.06);
    cursor:pointer;
    transition: all .12s ease;
    box-shadow: 0 6px 18px rgba(111,75,209,0.08);
  }
  .file-icon:hover,
  .file-icon:focus {
    background: linear-gradient(90deg,var(--hover-yellow-1), var(--hover-yellow-2));
    color:#111;
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
  }
  .file-icon svg { stroke: currentColor; fill: none; }

  .file-label-row{
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:10px;
    width:100%;
  }

  .file-name {
    color:var(--muted);
    font-size:0.95rem;
    text-align:center;
    max-width:220px;
    word-break:break-word;
  }

  /* Profile uploader (below avatar) */
  .profile-uploader {
    margin-top: 18px;
    margin-bottom: 24px;
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:12px;
    width:100%;
  }

  /* SPACER: pushes entrepreneurship block down within same left column */
  .left-spacer {
    height: 160px; /* increase/decrease this value to control separation */
    width:100%;
    flex:0 0 auto;
  }

  /* Entrepreneurship image (now lower in left column) */
  .business-square{
    width:240px;
    height:240px;
    border-radius:24px;
    background: linear-gradient(180deg,#faf9ff,#f4f2ff);
    border:6px solid rgba(111,75,209,0.03);
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden;
    padding:6px;
    box-shadow: 0 14px 36px rgba(111,75,209,0.04);
    margin-bottom:12px;
  }
  .business-square img{
    width:100%;
    height:100%;
    object-fit:cover;
    object-position:center;
    display:block;
    border-radius:18px;
  }

  .business-uploader {
    margin-top: 12px;
    margin-bottom: 24px;
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:8px;
    width:100%;
  }

  .form-card{
    background:var(--canvas);
    border-radius:var(--radius-lg);
    padding:20px;
    box-shadow:var(--card-shadow);
    border:1px solid rgba(111,75,209,0.02);
  }

  /* Right-side sections spacing */
  .section-panel{
    padding:14px;
    border-radius:12px;
    background: linear-gradient(180deg, rgba(111,75,209,0.02), rgba(255,255,255,0.8));
    border:1px solid rgba(111,75,209,0.03);
    margin-bottom:44px;
  }

  .section-title{
    font-size:1rem;
    font-weight:900;
    color:#2b2340;
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:10px 14px;
    border-radius:12px;
    background: linear-gradient(90deg, rgba(111,75,209,0.06), rgba(139,108,247,0.03));
    box-shadow: 0 8px 20px rgba(111,75,209,0.04);
    border-left:6px solid var(--purple-1);
    margin:0 0 8px 0;
  }

  .section-title .badge {
    display:inline-flex;
    width:34px;
    height:34px;
    align-items:center;
    justify-content:center;
    border-radius:8px;
    background: linear-gradient(90deg,var(--purple-1),var(--purple-2));
    color:#fff;
    font-weight:800;
    box-shadow: 0 6px 18px rgba(111,75,209,0.12);
    font-size:14px;
  }

  .section-desc{ color:var(--muted); margin-bottom:12px; font-weight:600; }

  .fields-grid{ display:grid; grid-template-columns: repeat(3, 1fr); gap:14px 18px; }

  .field{ display:flex; flex-direction:column; }
  .field label{ font-size:.9rem; color:var(--muted); margin-bottom:8px; font-weight:700; }

  .control{
    padding:12px 14px;
    border-radius:12px;
    border:1px solid rgba(111,75,209,0.08);
    background:#ffffff;
    font-size:.95rem;
    color:#222;
    box-shadow:
      0 30px 60px rgba(111,75,209,0.14),
      0 8px 20px rgba(0,0,0,0.10),
      inset 0 1px 0 rgba(255,255,255,0.6);
    transition:
      box-shadow .18s ease,
      border-color .12s ease,
      transform .08s ease,
      background .12s ease;
  }

  textarea.control{
    min-height:110px;
    resize:vertical;
    box-shadow:
      0 30px 60px rgba(111,75,209,0.14),
      0 8px 20px rgba(0,0,0,0.10),
      inset 0 1px 0 rgba(255,255,255,0.6);
  }

  .control:focus,
  .control:focus-visible{
    outline:none;
    border-color: var(--purple-1);
    background: #fff;
    box-shadow:
      0 40px 90px rgba(111,75,209,0.20),
      0 10px 30px rgba(0,0,0,0.14),
      inset 0 1px 0 rgba(255,255,255,0.7);
    transform: translateY(-1px);
  }

  .control::placeholder{ color:#9aa0aa; opacity:0.9; }

  .full{ grid-column: 1 / -1; }

  .divider{ height:1px; background: linear-gradient(90deg, rgba(111,75,209,0.03), rgba(111,75,209,0.01)); margin:16px 0; border-radius:2px; }

  .actions{ display:flex; gap:12px; justify-content:flex-end; margin-top:18px; align-items:center; }

  /* ====== UPDATED: make .btn-cancel visually match .btn-save (píldora) ====== */
  .btn-cancel {
    background: linear-gradient(90deg,var(--purple-1), var(--purple-2));
    color: #fff;
    padding:10px 20px;           /* match .btn-base/.btn-save padding */
    border-radius:999px;         /* make it pill-shaped, same as .btn-save */
    font-weight:800;             /* match .btn-save weight */
    border: none;
    box-shadow: 0 10px 30px rgba(111,75,209,0.12); /* match .btn-save shadow */
    transition: background .15s ease, color .12s ease, transform .12s ease, box-shadow .12s ease;
    display:inline-flex;
    align-items:center;
    justify-content:center;
  }
  .btn-cancel:hover,
  .btn-cancel:focus {
    background: linear-gradient(90deg,var(--hover-yellow-1), var(--hover-yellow-2));
    color:#111;
    transform: translateY(-3px);
    box-shadow: 0 14px 36px rgba(0,0,0,0.12);
    outline:none;
  }

  @media (max-width: 980px){
    .profile-main{ grid-template-columns: 1fr; }
    .fields-grid{ grid-template-columns: 1fr; }
    .profile-avatar, .business-square{ width:180px; height:180px; }
    .left-spacer { height: 80px; }
    .profile-uploader, .business-uploader { margin-bottom:20px; }
    .section-panel{ margin-bottom:30px; }
  }
</style>

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
            <div class="field full">
              <label>Descripción</label>
              <textarea class="control" name="description">{{ old('description', $entrepreneurship->description ?? '') }}</textarea>
              @error('description') <div style="color:#c33">{{ $message }}</div> @enderror
            </div>

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

            <div class="field full">
              <label>Email</label>
              <input class="control" type="email" name="email" value="{{ old('email', $entrepreneurship->email ?? '') }}">
              @error('email') <div style="color:#c33">{{ $message }}</div> @enderror
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Profile image input
    const mediaInput = document.getElementById('media_file');
    const mediaName = document.getElementById('media_file_name');
    const avatarPreview = document.getElementById('avatar-preview');

    if (mediaInput) {
      mediaInput.addEventListener('change', function () {
        const file = this.files && this.files[0];
        mediaName.textContent = file ? file.name : 'Ninguno seleccionado';
        if (file && avatarPreview && file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = function (ev) {
            if (avatarPreview.tagName === 'IMG') {
              avatarPreview.src = ev.target.result;
              avatarPreview.style.borderRadius = '18px';
            } else {
              const img = document.createElement('img');
              img.id = 'avatar-preview';
              img.src = ev.target.result;
              img.alt = 'Avatar';
              img.style.width = '100%';
              img.style.height = '100%';
              img.style.objectFit = 'cover';
              img.style.borderRadius = '18px';
              avatarPreview.replaceWith(img);
            }
          };
          reader.readAsDataURL(file);
        }
      });
    }

    // Business image input (left column)
    const businessInput = document.getElementById('business_media_file');
    const businessName = document.getElementById('business_media_file_name');
    const logoPreview = document.getElementById('logo-preview');

    if (businessInput) {
      businessInput.addEventListener('change', function () {
        const file = this.files && this.files[0];
        businessName.textContent = file ? file.name : 'Ninguno seleccionado';
        if (file && logoPreview && file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = function (ev) {
            if (logoPreview.tagName === 'IMG') {
              logoPreview.src = ev.target.result;
              logoPreview.style.borderRadius = '18px';
            } else {
              const img = document.createElement('img');
              img.id = 'logo-preview';
              img.src = ev.target.result;
              img.alt = 'Logo';
              img.style.width = '100%';
              img.style.height = '100%';
              img.style.objectFit = 'cover';
              img.style.borderRadius = '18px';
              logoPreview.replaceWith(img);
            }
          };
          reader.readAsDataURL(file);
        }
      });
    }

    // Accessibility: allow Enter/Space on file-icon labels to open file dialog
    document.querySelectorAll('.file-icon').forEach(function (label) {
      label.addEventListener('keydown', function (ev) {
        if (ev.key === ' ' || ev.key === 'Enter') {
          ev.preventDefault();
          const forId = this.getAttribute('for');
          const input = document.getElementById(forId);
          if (input) input.click();
        }
      });
    });
  });
</script>
@endsection