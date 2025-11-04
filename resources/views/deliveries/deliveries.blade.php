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
  .search svg { flex: 0 0 auto; display:block; }

  /* highlight match */
  .highlight {
    background: linear-gradient(90deg, rgba(143,103,237,0.18), rgba(143,103,237,0.08));
    padding: 2px 6px;
    border-radius: 6px;
  }

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

  <div class="search-row">
    <div class="search" role="search" aria-label="Buscar delivery">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <circle cx="10.5" cy="10.5" r="5.25" stroke="#000000ff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M17.25 17.25L21 21" stroke="#000000ff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>

      <!-- Added id and autocomplete off -->
      <input id="delivery-search" type="search" autocomplete="off" placeholder="Buscar delivery (ej. Glovo, Rappi, Piki...)" aria-label="Buscar delivery" />
    </div>
  </div>

  <section id="cards-list" class="cards" aria-label="Lista de servicios de delivery">
    <!-- Card: Piki -->
    <article class="card" data-title="piki app" data-content="Piki App es una plataforma de delivery 100% nicaragüense que ofrece entregas rápidas y seguras. Se enfoca en apoyar a pequeños y medianos emprendedores, facilitando la distribución de productos.">
      <div class="logo-wrap" aria-hidden="true">
        <img src="{{ asset('assets/images/piki.png') }}" alt="Piki logo">
      </div>

      <div>
        <h3>Piki App</h3>
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
    <article class="card" data-title="glovo" data-content="Glovo es una app de delivery activa en Managua y otras ciudades. Ofrece soluciones logísticas para emprendedores que venden productos como accesorios, ropa o tecnología.">
      <div class="logo-wrap">
        <img src="{{ asset('assets/images/glovo.png') }}" alt="Glovo logo">
      </div>

      <div>
        <h3>Glovo</h3>
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
    <article class="card" data-title="rappi" data-content="Rappi opera en zonas urbanas y ayuda a emprendedores a entregar sus productos de manera rápida y segura. Plataforma conocida por su alcance y variedad de servicios.">
      <div class="logo-wrap">
        <img src="{{ asset('assets/images/rappi.png') }}" alt="Rappi logo">
      </div>

      <div>
        <h3>Rappi</h3>
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
    <article class="card" data-title="pedidosya" data-content="PedidosYa es una plataforma de delivery presente en distintos departamentos, usada por miles de personas. Se especializa en entregas rápidas de productos de conveniencia y comida.">
      <div class="logo-wrap">
        <img src="{{ asset('assets/images/pedidosya.png') }}" alt="PedidosYa logo">
      </div>

      <div>
        <h3>PedidosYa</h3>
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

  <div class="note-footer" id="search-note" aria-live="polite" style="display:none;">
    No se encontraron resultados para "<span id="search-term"></span>"
  </div>
</main>

<script>
  (function () {
    const input = document.getElementById('delivery-search');
    const cards = Array.from(document.querySelectorAll('#cards-list .card'));
    const note = document.getElementById('search-note');
    const searchTermSpan = document.getElementById('search-term');

    // Utility: escape regex special chars
    function escapeRegExp(string) {
      return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    // Debounce to avoid excessive filtering on fast typing
    function debounce(fn, wait = 180) {
      let t;
      return function (...args) {
        clearTimeout(t);
        t = setTimeout(() => fn.apply(this, args), wait);
      };
    }

    // Remove previous highlights in an element
    function removeHighlights(node) {
      const highlighted = node.querySelectorAll('.highlight');
      highlighted.forEach(span => {
        const textNode = document.createTextNode(span.textContent);
        span.replaceWith(textNode);
      });
    }

    // Highlight matches in text nodes inside a container
    function highlightText(container, query) {
      if (!query) return;
      const regex = new RegExp('(' + escapeRegExp(query) + ')', 'ig');

      // Highlight inside headings and description only
      ['h3', '.desc'].forEach(selector => {
        const el = container.querySelector(selector);
        if (!el) return;

        // Remove existing highlights first
        removeHighlights(el);

        // Walk text nodes and replace matches
        const walker = document.createTreeWalker(el, NodeFilter.SHOW_TEXT, null, false);
        const texts = [];
        while (walker.nextNode()) texts.push(walker.currentNode);

        texts.forEach(textNode => {
          const parent = textNode.parentNode;
          const val = textNode.nodeValue;
          if (!val) return;
          const parts = val.split(regex);
          if (parts.length === 1) return; // no match

          const frag = document.createDocumentFragment();
          parts.forEach((part, i) => {
            if (i % 2 === 1) {
              const span = document.createElement('span');
              span.className = 'highlight';
              span.textContent = part;
              frag.appendChild(span);
            } else {
              frag.appendChild(document.createTextNode(part));
            }
          });
          parent.replaceChild(frag, textNode);
        });
      });
    }

    function filterCards(term) {
      const q = term.trim().toLowerCase();

      let visibleCount = 0;

      cards.forEach(card => {
        // prepare searchable text
        const title = (card.getAttribute('data-title') || '').toLowerCase();
        const content = (card.getAttribute('data-content') || '').toLowerCase();
        const combined = title + ' ' + content;

        // clear old highlights
        removeHighlights(card);

        if (!q || combined.indexOf(q) !== -1) {
          // show
          card.style.display = '';
          visibleCount++;
          // highlight matches
          if (q) highlightText(card, q);
        } else {
          // hide
          card.style.display = 'none';
        }
      });

      // show "no results" note if nothing visible and query exists
      if (q && visibleCount === 0) {
        searchTermSpan.textContent = term;
        note.style.display = '';
      } else {
        note.style.display = 'none';
      }
    }

    const debouncedFilter = debounce(function (e) {
      filterCards(e.target.value);
    }, 160);

    // Add listeners
    input.addEventListener('input', debouncedFilter);
    input.addEventListener('search', function (e) {
      // 'search' event fires when user clears the search in some browsers
      filterCards(e.target.value || '');
    });

    // Optional: allow pressing Escape to clear search
    input.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') {
        input.value = '';
        filterCards('');
        input.blur();
      }
    });

    // Initialize (in case the input has prefilled value)
    document.addEventListener('DOMContentLoaded', function () {
      if (input.value) filterCards(input.value);
    });
  })();
</script>
@endsection