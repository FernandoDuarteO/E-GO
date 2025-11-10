@extends('layouts.clients')

@section('content')
@php $isPaginated = method_exists($products, 'links'); @endphp

<style>
/* Tus estilos existentes (compactados) */
.clients-products { padding: 1.25rem 1rem 3rem; }
.clients-products h2 { font-weight: 700; font-size: 1.6rem; color: #1f2140; margin-bottom: 1rem; }
.product-grid { margin-top: .5rem; display:grid; grid-template-columns: repeat(4, 1fr); gap:1.25rem; }
@media (max-width:1199.98px){ .product-grid{ grid-template-columns: repeat(3,1fr);} }
@media (max-width:899.98px){ .product-grid{ grid-template-columns: repeat(2,1fr);} }
@media (max-width:575.98px){ .product-grid{ grid-template-columns: 1fr; } }
.product-card { border-radius: 12px; overflow: hidden; transition: transform .12s ease, box-shadow .12s ease; background: #ffffff; position: relative; }
.product-card:hover { transform: translateY(-6px); box-shadow: 0 10px 25px rgba(31,33,64,0.08); }
.card-img-top { width: 100%; height: 210px; object-fit: cover; object-position: center; display: block; background: #f4f4f8; }
.card-body { background: linear-gradient(180deg, #ffffff 0%, #f6f5fb 100%); padding: 0.9rem; }
.card-title { font-size: 1rem; font-weight: 600; color: #222236; margin-bottom: .35rem; }
.price { font-weight: 700; color: #2a2a48; margin-bottom: .25rem; }
.category-badge { font-size: 0.78rem; padding: .28rem .55rem; border-radius: 999px; background: linear-gradient(180deg,#8b6be7,#6b4be2); color: #fff; box-shadow: 0 6px 12px rgba(107,75,226,0.12); }
.meta { font-size: .82rem; color: #6b6b85; }
.eye-btn { position:absolute; right:16px; bottom:16px; z-index:6; width:44px; height:44px; border-radius:10px; display:inline-flex; align-items:center; justify-content:center; background: linear-gradient(180deg,#7f58e6,#5f39d6); color:#fff; border:none; box-shadow:0 8px 18px rgba(31,33,64,0.08); cursor:pointer; }
.eye-btn:focus { outline:2px solid rgba(127,88,230,0.25); }
.product-card-link { display:block; color:inherit; text-decoration:none; }
.add-cart-btn { position:absolute; left:16px; bottom:16px; z-index:6; width:44px; height:44px; border-radius:10px; display:inline-flex; align-items:center; justify-content:center; background: linear-gradient(180deg,#ffd36b,#ffb84d); color:#222; border:none; box-shadow:0 8px 18px rgba(31,33,64,0.06); cursor:pointer; }
.add-cart-btn:focus { outline:2px solid rgba(0,0,0,0.08); }
.modal-spinner { width:24px;height:24px;display:inline-block; }
.cart-feedback {
    position: fixed;
    right: 24px;
    bottom: 24px;
    background: rgba(34,34,52,0.95);
    color: #fff;
    padding: 10px 14px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(15,15,40,0.3);
    z-index: 99999;
    font-size: 0.95rem;
    display: none;
}
@media (max-width: 575.98px) { .card-img-top { height: 170px; } }
</style>

<div class="container mt-4 clients-products" id="clientsProductsContainer">
    <div class="d-flex align-items-center mb-4">
        <h2 class="mb-0">Productos</h2>
    </div>

    <div class="product-grid" id="productGrid">
        @forelse($products as $product)
            @php
                // Obtener la primera imagen (compatibilidad con productImages, product_images, images o media_file)
                $firstImage = null;
                if (isset($product->productImages) && $product->productImages instanceof \Illuminate\Support\Collection && $product->productImages->count()) {
                    $img = $product->productImages->first();
                    $firstImage = $img->file_path ?? $img->path ?? $img->url ?? null;
                } elseif (isset($product->product_images) && $product->product_images instanceof \Illuminate\Support\Collection && $product->product_images->count()) {
                    $img = $product->product_images->first();
                    $firstImage = $img->file_path ?? $img->path ?? $img->url ?? null;
                } elseif (isset($product->images) && $product->images instanceof \Illuminate\Support\Collection && $product->images->count()) {
                    $img = $product->images->first();
                    $firstImage = $img->file_path ?? $img->path ?? $img->url ?? null;
                } elseif (!empty($product->media_file)) {
                    $firstImage = $product->media_file;
                }

                $imageUrl = null;
                if ($firstImage) {
                    $imageUrl = preg_match('/^https?:\\/\\//i', $firstImage) ? $firstImage : asset('storage/' . ltrim($firstImage, '/'));
                }
            @endphp

            <div class="product-card card h-100 shadow-sm border-0" data-product-id="{{ $product->id }}">
                <a href="{{ route('clients.products.show', $product->id) }}" class="product-card-link" title="{{ $product->name }}" aria-label="Ver {{ $product->name }}">
                    @if($imageUrl)
                        <img src="{{ $imageUrl }}" class="card-img-top" alt="{{ $product->name }}" loading="lazy">
                    @else
                        <img src="https://via.placeholder.com/400x300?text=Sin+Imagen" class="card-img-top" alt="Sin imagen" loading="lazy">
                    @endif

                    <div class="card-body p-3">
                        <h6 class="card-title">{{ $product->name }}</h6>

                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <p class="mb-0 price">C$ {{ number_format($product->price ?? 0, 2) }}</p>
                                <small class="text-muted d-block" style="font-size:.82rem;">{{ \Illuminate\Support\Str::limit($product->description ?? '', 60) }}</small>
                            </div>
                            <div class="ms-2 text-end">
                                <span class="badge category-badge">{{ optional($product->category)->type ?? 'Sin categoría' }}</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <small class="meta">{{ $product->vendor_name ?? optional($product->user)->name ?? 'Emprendedor' }}</small>
                        </div>
                    </div>
                </a>

                <!-- Add to cart button -->
                <button type="button"
                        class="add-cart-btn"
                        data-id="{{ $product->id }}"
                        aria-label="Agregar {{ $product->name }} al carrito"
                        title="Agregar al carrito">
                    <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                </button>

                <button type="button"
                        class="eye-btn open-product-modal"
                        data-id="{{ $product->id }}"
                        aria-label="Vista rápida de {{ $product->name }}"
                        title="Vista rápida">
                    <i class="fas fa-eye" aria-hidden="true"></i>
                </button>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">No hay productos disponibles.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        @if($isPaginated)
            {{ $products->links() }}
        @endif
    </div>
</div>

<!-- Small feedback element -->
<div id="cartFeedback" class="cart-feedback" role="status" aria-live="polite"></div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Evitar auto-open multiple times
    if (!window._clientProductAutoOpenRun) window._clientProductAutoOpenRun = false;

    async function openProductModal(productId, btn) {
        const url = `/clients/products/${productId}?ajax=1`;
        const controller = new AbortController();
        const timeout = setTimeout(() => controller.abort(), 10000);

        let prevHtml = null;
        if (btn) { prevHtml = btn.innerHTML; btn.innerHTML = '<span class="modal-spinner"><i class="fas fa-spinner fa-pulse"></i></span>'; btn.disabled = true; }

        try {
            const res = await fetch(url, {
                method: 'GET',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'text/html' },
                credentials: 'same-origin',
                signal: controller.signal
            });

            if (!res.ok) {
                console.error('openProductModal: status', res.status);
                alert('No se pudo cargar el detalle (error servidor).');
                return;
            }

            const text = await res.text();

            // Comprobar que el fragmento contiene el wrapper o productModal
            const hasFragment = /id=(["'])clientProductModalWrapper\1/i.test(text) || /id=(["'])productModal\1/i.test(text);
            if (!hasFragment) {
                console.error('openProductModal: respuesta no contiene fragmento modal');
                alert('No se recibió la vista rápida. Intente recargar la página.');
                return;
            }

            // eliminar wrapper previo
            const prev = document.getElementById('clientProductModalWrapper');
            if (prev) prev.remove();

            const wrapper = document.createElement('div');
            wrapper.id = 'clientProductModalWrapper';
            wrapper.innerHTML = text;
            document.body.appendChild(wrapper);

            // llamar inicializador expuesto por el fragmento si existe
            if (typeof window.initClientProductModal === 'function') {
                try { window.initClientProductModal(wrapper); } catch (err) { console.error('initClientProductModal error', err); }
            }

            const closeBtn = wrapper.querySelector('#modalCloseBtn, [data-action="close"]');
            if (closeBtn) closeBtn.focus();

        } catch (err) {
            if (err.name === 'AbortError') {
                alert('La solicitud tardó demasiado. Intente de nuevo.');
            } else {
                console.error('openProductModal error', err);
                alert('Error al cargar detalle del producto.');
            }
        } finally {
            clearTimeout(timeout);
            if (btn) { btn.disabled = false; btn.innerHTML = prevHtml || '<i class="fas fa-eye"></i>'; }
        }
    }

    // Delegación para botones "ojo"
    document.body.addEventListener('click', function (e) {
        const btn = e.target.closest('.open-product-modal');
        if (!btn) return;
        e.preventDefault();
        e.stopPropagation();
        const pid = btn.getAttribute('data-id');
        if (!pid) return;
        openProductModal(pid, btn);
    }, true);

    // Auto-open a partir de ?open=ID (solo una vez)
    (function autoOpenFromQuery() {
        if (window._clientProductAutoOpenRun) return;
        const params = new URLSearchParams(window.location.search);
        const open = params.get('open');
        if (!open) return;
        window._clientProductAutoOpenRun = true;
        setTimeout(() => {
            openProductModal(open, null);
            params.delete('open');
            const newUrl = window.location.pathname + (params.toString() ? '?' + params.toString() : '') + window.location.hash;
            window.history.replaceState({}, '', newUrl);
        }, 150);
    })();

    // --- Carrito: add-to-cart desde las cards ---
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : null;

    function showCartFeedback(message) {
        const el = document.getElementById('cartFeedback');
        if (!el) return;
        el.textContent = message;
        el.style.display = 'block';
        el.style.opacity = '1';
        clearTimeout(window._cartFeedbackTimer);
        window._cartFeedbackTimer = setTimeout(() => {
            el.style.transition = 'opacity 300ms';
            el.style.opacity = '0';
            setTimeout(()=> el.style.display = 'none', 300);
        }, 1200);
    }

    async function addToCart(productId, qty = 1, btn) {
        if (!csrfToken) {
            alert('Token CSRF no encontrado. Asegúrate de que tu layout incluya <meta name="csrf-token">');
            return;
        }
        if (btn) { btn.disabled = true; const orig = btn.innerHTML; btn.innerHTML = '<i class="fas fa-spinner fa-pulse"></i>'; }
        try {
            const res = await fetch('/cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ product_id: productId, quantity: qty })
            });
            const json = await res.json();
            if (json && json.success) {
                // actualizar contador de carrito si existe (por ejemplo #cartBadge)
                const badge = document.getElementById('cartBadge');
                if (badge) {
                    if (typeof json.cart_count !== 'undefined') {
                        badge.textContent = json.cart_count;
                    } else {
                        // si no viene cart_count, incrementar visualmente
                        const n = parseInt(badge.textContent||'0',10) || 0;
                        badge.textContent = n + 1;
                    }
                }
                showCartFeedback('Agregado al carrito');
            } else {
                console.error('addToCart response', json);
                alert(json && json.message ? json.message : 'No se pudo agregar al carrito.');
            }
        } catch (err) {
            console.error('addToCart error', err);
            alert('Error al agregar al carrito.');
        } finally {
            if (btn) { btn.disabled = false; btn.innerHTML = '<i class="fas fa-shopping-cart"></i>'; }
        }
    }

    // Delegación para add-cart-btn
    document.body.addEventListener('click', function (e) {
        const b = e.target.closest('.add-cart-btn');
        if (!b) return;
        e.preventDefault();
        e.stopPropagation();
        const pid = b.getAttribute('data-id');
        if (!pid) return;
        addToCart(pid, 1, b);
    }, true);
});
</script>
@endsection