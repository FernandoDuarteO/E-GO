@extends('layouts.clients')

@section('content')
<style>
/* (mantén o mueve tu CSS aquí) */
.clients-products { padding: 1.25rem 1rem 3rem; }
.clients-products h2 { font-weight: 700; font-size: 1.6rem; color: #1f2140; margin-bottom: 1rem; }
.product-grid { margin-top: .5rem; }
.product-card { border-radius: 12px; overflow: hidden; transition: transform .12s ease, box-shadow .12s ease; background: #ffffff; position: relative; }
.product-card:hover { transform: translateY(-6px); box-shadow: 0 10px 25px rgba(31,33,64,0.08); }
.product-card .card-img-top { width: 100%; height: 210px; object-fit: cover; object-position: center; display: block; background: #f4f4f8; }
.product-card .card-body { background: linear-gradient(180deg, #ffffff 0%, #f6f5fb 100%); padding: 0.9rem; }
.product-card .card-title { font-size: 1rem; font-weight: 600; color: #222236; margin-bottom: .35rem; }
.product-card .price { font-weight: 700; color: #2a2a48; margin-bottom: .25rem; }
.category-badge { font-size: 0.78rem; padding: .28rem .55rem; border-radius: 999px; background: linear-gradient(180deg,#8b6be7,#6b4be2); color: #fff; box-shadow: 0 6px 12px rgba(107,75,226,0.12); }
.product-card-actions .custom-purple-btn { background: #6b4be2; border: none; color: #fff; padding: 0.45rem 0.52rem; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 5px 12px rgba(107,75,226,0.12); cursor: pointer; text-decoration: none; }
.product-card-actions .custom-purple-btn:hover { background: #5a3bd6; }
.product-card .meta { font-size: .82rem; color: #6b6b85; }
.card .badge-pill { border-radius: 999px; }
@media (max-width: 575.98px) { .product-card .card-img-top { height: 170px; } }

/* small spinner while loading modal */
.modal-spinner {
    width:44px;height:44px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;background:rgba(0,0,0,0.06);
}
</style>

<div class="container mt-4 clients-products">
    <div class="d-flex align-items-center mb-4">
        <h2 class="mb-0">Productos</h2>
    </div>

    <div class="row g-4 product-grid">
        @forelse($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0 product-card">
                    @php
                        // Obtener la primera imagen (compatibilidad con product_images, images o media_file)
                        $firstImage = null;
                        if (isset($product->product_images) && $product->product_images instanceof \Illuminate\Support\Collection && $product->product_images->count()) {
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
                            if (preg_match('/^https?:\\/\\//i', $firstImage)) {
                                $imageUrl = $firstImage;
                            } else {
                                $imageUrl = asset('storage/' . ltrim($firstImage, '/'));
                            }
                        }
                    @endphp

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

                            <div class="product-card-actions">
                                <!-- Botón abre modal AJAX: no navega -->
                                <button type="button"
                                        class="btn btn-sm custom-purple-btn open-product-modal"
                                        data-id="{{ $product->id }}"
                                        aria-label="Ver producto">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">No hay productos disponibles.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        @if(method_exists($products,'links'))
            {{ $products->links() }}
        @endif
    </div>
</div>

{{-- JS: abre modal por AJAX (inserta el contenido del show con ?ajax=1) y define initClientProductModal --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    /**
     * Inicializa el comportamiento del modal.
     * wrapper: elemento contenedor que contiene el modal HTML (por ejemplo element with id clientProductModalWrapper)
     */
    window.initClientProductModal = function (wrapper) {
        if (!wrapper) return;
        const modal = wrapper.querySelector('#productModal');
        if (!modal) return;

        // bloquear scroll del body mientras modal abierto
        document.documentElement.style.overflow = 'hidden';
        document.body.style.overflow = 'hidden';

        const overlay = wrapper.querySelector('#productModalOverlay');
        const closeBtn = wrapper.querySelector('#modalCloseBtn');
        const mainImg = wrapper.querySelector('#main-product-image');
        const thumbs = wrapper.querySelectorAll('#thumbnail-list .thumb');
        const prev = wrapper.querySelector('#arrow-prev');
        const next = wrapper.querySelector('#arrow-next');

        // build imageUrls array from thumbs or from data attributes
        let imageUrls = [];
        if (thumbs && thumbs.length) {
            thumbs.forEach(t => {
                const imgEl = t.querySelector('img');
                if (imgEl && imgEl.src) imageUrls.push(imgEl.src);
            });
        } else {
            // fallback: read main image only
            if (mainImg && mainImg.src) imageUrls.push(mainImg.src);
        }

        let currentIndex = 0;
        function showIndex(idx) {
            if (!imageUrls[idx]) return;
            currentIndex = idx;
            if (mainImg) mainImg.src = imageUrls[idx];
            if (thumbs && thumbs.length) {
                thumbs.forEach(t => t.classList.remove('active'));
                const active = wrapper.querySelector('#thumbnail-list .thumb[data-index="' + idx + '"]');
                if (active) active.classList.add('active');
            }
        }

        // thumbnails click
        if (thumbs && thumbs.length) {
            thumbs.forEach(t => {
                t.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const idx = parseInt(this.getAttribute('data-index'));
                    showIndex(idx);
                });
            });
        }

        // arrows
        if (prev) {
            prev.addEventListener('click', function (e) {
                e.stopPropagation();
                const nextIndex = (currentIndex - 1 + imageUrls.length) % imageUrls.length;
                showIndex(nextIndex);
            });
        }
        if (next) {
            next.addEventListener('click', function (e) {
                e.stopPropagation();
                const nextIndex = (currentIndex + 1) % imageUrls.length;
                showIndex(nextIndex);
            });
        }

        // keyboard support
        function keyHandler(e) {
            if (e.key === 'ArrowLeft') {
                showIndex((currentIndex - 1 + imageUrls.length) % imageUrls.length);
            } else if (e.key === 'ArrowRight') {
                showIndex((currentIndex + 1) % imageUrls.length);
            } else if (e.key === 'Escape') {
                cleanupModal();
            }
        }
        document.addEventListener('keydown', keyHandler);

        // close
        function cleanupModal() {
            // animación opcional
            if (modal) modal.style.animation = 'modalOut .18s ease forwards';
            if (overlay) overlay.style.opacity = '0';
            // restaurar scroll
            document.documentElement.style.overflow = '';
            document.body.style.overflow = '';
            // eliminar wrapper después de animación
            setTimeout(() => {
                const w = document.getElementById('clientProductModalWrapper');
                if (w) w.remove();
            }, 190);
            // limpiar listener
            document.removeEventListener('keydown', keyHandler);
        }
        if (closeBtn) closeBtn.addEventListener('click', function (e) { e.preventDefault(); cleanupModal(); });
        if (overlay) overlay.addEventListener('click', function (e) { if (e.target === overlay) cleanupModal(); });

        // Review form logic: stars, show/hide form, cancel
        const openReviewBtn = wrapper.querySelector('#openReviewBtn');
        const reviewFormContainer = wrapper.querySelector('#reviewFormContainer');
        const cancelReviewBtn = wrapper.querySelector('#cancelReviewBtn');
        const stars = wrapper.querySelectorAll('#stars .star');
        const ratingInput = wrapper.querySelector('#rating-input');

        if (openReviewBtn && reviewFormContainer) {
            openReviewBtn.addEventListener('click', function (e) {
                e.preventDefault();
                reviewFormContainer.style.display = 'block';
                reviewFormContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        }
        if (cancelReviewBtn) {
            cancelReviewBtn.addEventListener('click', function (e) {
                e.preventDefault();
                if (reviewFormContainer) reviewFormContainer.style.display = 'none';
                if (ratingInput) ratingInput.value = '';
                if (wrapper.querySelector('#comment')) wrapper.querySelector('#comment').value = '';
                if (stars && stars.length) stars.forEach(s => s.classList.remove('selected'));
            });
        }
        if (stars && stars.length) {
            stars.forEach(s => {
                s.addEventListener('mouseenter', function () {
                    const v = parseInt(this.dataset.value);
                    stars.forEach(x => x.classList.toggle('selected', parseInt(x.dataset.value) <= v));
                });
                s.addEventListener('mouseleave', function () {
                    const current = parseInt(ratingInput?.value || 0);
                    stars.forEach(x => x.classList.toggle('selected', parseInt(x.dataset.value) <= current));
                });
                s.addEventListener('click', function () {
                    const v = parseInt(this.dataset.value);
                    if (ratingInput) ratingInput.value = v;
                    stars.forEach(x => x.classList.toggle('selected', parseInt(x.dataset.value) <= v));
                });
            });
        }

        // inicializar
        showIndex(0);
    }; // end initClientProductModal

    /* AJAX open modal */
    async function openProductModal(productId, btn) {
        try {
            const url = `/clients/products/${productId}?ajax=1`;
            // spinner feedback
            let prevHtml = null;
            if (btn) {
                prevHtml = btn.innerHTML;
                btn.innerHTML = '<span class="modal-spinner"><i class="fas fa-spinner fa-pulse"></i></span>';
            }

            const res = await fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'same-origin'
            });
            if (!res.ok) throw new Error('Error al cargar modal: ' + res.status);

            const html = await res.text();

            // insertar wrapper y modal (si ya existe lo reemplazamos)
            let wrapper = document.getElementById('clientProductModalWrapper');
            if (wrapper) wrapper.remove();
            wrapper = document.createElement('div');
            wrapper.id = 'clientProductModalWrapper';
            wrapper.innerHTML = html;
            document.body.appendChild(wrapper);

            // inicializa el modal (asegura que la lógica se ejecute)
            if (typeof window.initClientProductModal === 'function') {
                window.initClientProductModal(wrapper);
            }

            // restaurar botón
            if (btn && prevHtml !== null) btn.innerHTML = prevHtml;
        } catch (err) {
            console.error(err);
            alert('No se pudo abrir el detalle del producto.');
            if (btn) btn.innerHTML = '<i class="fas fa-eye"></i>';
        }
    }

    // Delegación: escucha clicks en cualquier botón .open-product-modal
    document.body.addEventListener('click', function (e) {
        const btn = e.target.closest('.open-product-modal');
        if (!btn) return;
        const productId = btn.getAttribute('data-id');
        if (!productId) return;
        openProductModal(productId, btn);
    });
});
</script>
@endsection