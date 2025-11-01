@extends('layouts.app')

@section('content')
<style>
  :root{
    --bg: #f7f7fb;
    --card-bg: #f0eefe;
    --panel: #ffffff;
    --muted: #7b7f86;
    --accent: #6f4bd1;
    --accent-2: #8b6cf7;
    --radius: 14px;
    --gap: 18px;
    --shadow: 0 14px 40px rgba(111,75,209,0.06);
  }

  /* Page container */
  .deliveries-wrap {
    max-width:1060px;
    margin:36px auto;
    padding:28px;
    background:var(--panel);
    border-radius:16px;
    box-shadow: var(--shadow);
    border:1px solid rgba(111,75,209,0.03);
  }

  .page-title{
    font-size:28px;
    font-weight:800;
    color:var(--accent);
    margin:0 0 18px 0;
  }

  .search-row{
    display:flex;
    gap:12px;
    align-items:center;
    margin-bottom:18px;
  }
  .search {
    flex:1;
    display:flex;
    align-items:center;
    gap:10px;
    background: linear-gradient(180deg,#fbf8ff,#f4f1ff);
    padding:8px 14px;
    border-radius:999px;
    border:1px solid rgba(111,75,209,0.04);
  }
  .search input{
    border:0; outline:none; background:transparent; font-size:14px; width:100%;
  }
  /* Make the search icon color match the design and sit well */
  .search svg { flex: 0 0 auto; display:block; }

  /* Cards list */
  .cards {
    display:flex;
    flex-direction:column;
    gap:18px;
  }

  .card {
    display:grid;
    grid-template-columns: 120px 1fr 140px;
    gap:18px;
    align-items:center;
    padding:18px;
    background:var(--card-bg);
    border-radius:12px;
    border:1px solid rgba(111,75,209,0.03);
    box-shadow: 0 6px 18px rgba(111,75,209,0.03);
  }

  .logo-wrap{
    width:120px;
    height:120px;
    display:flex;
    align-items:center;
    justify-content:center;
    background: linear-gradient(180deg,#fff,#f8f6ff);
    border-radius:12px;
    padding:10px;
    box-shadow: 0 8px 22px rgba(111,75,209,0.04);
  }
  .logo-wrap img{
    max-width:100%;
    max-height:100%;
    object-fit:contain;
    display:block;
  }

  .card h3{ margin:0 0 6px 0; font-size:16px; font-weight:800; color:#111; }
  .card p.desc{ margin:0 0 8px 0; color:var(--muted); font-size:13px; line-height:1.4; }
  .contact {
    font-size:13px;
    color:#222;
  }
  .contact small { display:block; color:var(--muted); margin-top:6px; font-weight:600; }

  .rating {
    display:flex;
    flex-direction:column;
    align-items:flex-end;
    gap:10px;
  }

  .stars{
    color:#f4c34a;
    font-size:18px;
    letter-spacing:2px;
  }
  .btns {
    display:flex;
    gap:8px;
  }

  /* button style (informational) */
  .btn {
    padding:8px 14px;
    border-radius:999px;
    background: linear-gradient(90deg,var(--accent),var(--accent-2));
    color:#fff;
    font-weight:700;
    border:0;
    cursor:default;
    box-shadow: 0 8px 22px rgba(111,75,209,0.10);
    font-size:13px;
  }

  .note-footer{
    margin-top:22px;
    padding:14px;
    background:linear-gradient(180deg, #f4f2ff, #fff);
    border-radius:10px;
    color:var(--muted);
    font-size:13px;
  }

  /* Responsive */
  @media (max-width:880px){
    .card { grid-template-columns: 92px 1fr; grid-template-rows: auto auto; }
    .rating { grid-column: 1 / -1; align-items:flex-start; }
    .logo-wrap{ width:92px; height:92px; }
  }

  @media (max-width:520px){
    .deliveries-wrap{ padding:18px; margin:18px; }
    .card { grid-template-columns: 1fr; grid-template-rows: auto auto auto; gap:10px; }
    .rating { align-items:flex-start; }
    .logo-wrap{ width:120px; height:120px; margin:0 auto; }
  }
</style>

<main class="deliveries-wrap" role="main" aria-labelledby="title-deliveries">
  <h1 id="title-deliveries" class="page-title">Deliverys para ti</h1>

  <div class="search-row" aria-hidden="true">
    <div class="search" role="search" aria-label="Buscar delivery">
      <!-- Search icon: magnifying glass (accessible and styled) -->
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <circle cx="10.5" cy="10.5" r="5.25" stroke="#000000ff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M17.25 17.25L21 21" stroke="#000000ff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>

      <input placeholder="Buscar delivery (ej. Glovo, Rappi, Piki...)" aria-label="Buscar delivery" />
    </div>
  </div>

  <section class="cards" aria-label="Lista de servicios de delivery">
    <!-- Card: Piki -->
    <article class="card" aria-labelledby="piki-title">
      <div class="logo-wrap" aria-hidden="true">
        <img src="{{ asset('assets/images/piki.png') }}" alt="Piki logo">
      </div>

      <div>
        <h3 id="piki-title">Piki App</h3>
        <p class="desc">
          Piki App es una plataforma de delivery 100% nicaragüense que ofrece entregas rápidas y seguras.
          Se enfoca en apoyar a pequeños y medianos emprendedores, facilitando la distribución de productos.
        </p>
        <div class="contact">
          <strong>Contactos:</strong>
          <small>Teléfono: +505 4444-4444 · Correo: pikiapp@nc</small>
        </div>
      </div>

      <div class="rating" aria-hidden="true">
        <div class="stars">★★★★★</div>
      </div>
    </article>

    <!-- Card: Glovo -->
    <article class="card" aria-labelledby="glovo-title">
      <div class="logo-wrap">
        <img src="{{ asset('assets/images/glovo.png') }}" alt="Glovo logo">
      </div>

      <div>
        <h3 id="glovo-title">Glovo</h3>
        <p class="desc">
          Glovo es una app de delivery activa en Managua y otras ciudades.
          Ofrece soluciones logísticas para emprendedores que venden productos como accesorios, ropa o tecnología.
        </p>
        <div class="contact">
          <strong>Contactos:</strong>
          <small>Teléfono: +505 3333-3333 · Correo: glovo@nc</small>
        </div>
      </div>

      <div class="rating" aria-hidden="true">
        <div class="stars">★★★★★</div>
      </div>
    </article>

    <!-- Card: Rappi -->
    <article class="card" aria-labelledby="rappi-title">
      <div class="logo-wrap">
        <img src="{{ asset('assets/images/rappi.png') }}" alt="Rappi logo">
      </div>

      <div>
        <h3 id="rappi-title">Rappi</h3>
        <p class="desc">
          Rappi opera en zonas urbanas y ayuda a emprendedores a entregar sus productos de manera rápida y segura.
          Plataforma conocida por su alcance y variedad de servicios.
        </p>
        <div class="contact">
          <strong>Contactos:</strong>
          <small>Teléfono: +505 2222-2222 · Correo: rappi@nc</small>
        </div>
      </div>

      <div class="rating" aria-hidden="true">
        <div class="stars">★★★★★</div>
      </div>
    </article>

    <!-- Card: PedidosYa -->
    <article class="card" aria-labelledby="pedidosya-title">
      <div class="logo-wrap">
        <img src="{{ asset('assets/images/pedidosya.png') }}" alt="PedidosYa logo">
      </div>

      <div>
        <h3 id="pedidosya-title">PedidosYa</h3>
        <p class="desc">
          PedidosYa es una plataforma de delivery presente en distintos departamentos, usada por miles de personas.
          Se especializa en entregas rápidas de productos de conveniencia y comida.
        </p>
        <div class="contact">
          <strong>Contactos:</strong>
          <small>Teléfono: +505 1111-1111 · Correo: pedidosya@nc</small>
        </div>
      </div>

      <div class="rating" aria-hidden="true">
        <div class="stars">★★★★★</div>
      </div>
    </article>
  </section>
</main>

<script>
  // No interactive behaviour requested; script left empty intentionally.
  (function(){ /* noop */ })();
</script>
@endsection