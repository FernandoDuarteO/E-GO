@extends('layouts.clients')
@section('content')
@php
    // Detectar petición AJAX (fetch desde products) o query ?ajax=1
    $isAjax = request()->ajax() || request()->query('ajax');

    // Normalizar imágenes (variantes de relación/columnas)
    $images = collect();
    if (isset($product->images) && $product->images instanceof \Illuminate\Support\Collection && $product->images->count()) {
        $images = $product->images;
    } elseif (isset($product->product_images) && $product->product_images instanceof \Illuminate\Support\Collection && $product->product_images->count()) {
        $images = $product->product_images;
    } elseif (isset($product->productImages) && $product->productImages instanceof \Illuminate\Support\Collection && $product->productImages->count()) {
        $images = $product->productImages;
    }

    $imageUrls = [];
    foreach ($images as $img) {
        $val = $img->file_path ?? $img->path ?? $img->url ?? null;
        if ($val) {
            if (preg_match('/^https?:\\/\\//i', $val)) {
                $imageUrls[] = $val;
            } else {
                $imageUrls[] = asset('storage/' . ltrim($val, '/'));
            }
        }
    }

    if (empty($imageUrls) && !empty($product->media_file)) {
        $val = $product->media_file;
        if (preg_match('/^https?:\\/\\//i', $val)) {
            $imageUrls[] = $val;
        } else {
            $imageUrls[] = asset('storage/' . ltrim($val, '/'));
        }
    }

    if (empty($imageUrls)) {
        $imageUrls[] = 'https://via.placeholder.com/900x700?text=Sin+imagen';
    }

    $mainImage = $imageUrls[0] ?? null;
@endphp

{{-- Modal fragment (used for both AJAX injection and direct access) --}}
@php
    // Generate modal HTML in a variable to avoid duplication mistakes in logic comments (we still output it below)
@endphp

<style>
/* Modal & overlay core styles */
.product-show-overlay {
    position: fixed;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 3000;
    padding: 2rem;
    background: rgba(24, 22, 30, 0.36);
    -webkit-backdrop-filter: blur(3px) saturate(1.02);
    backdrop-filter: blur(3px) saturate(1.02);
}
.product-modal {
    width: 100%;
    max-width: 860px;
    max-height: 86vh;
    background: linear-gradient(180deg,#fff,#fbf9ff);
    border-radius: 12px;
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 1rem;
    box-shadow: 0 36px 70px rgba(15,15,40,0.40);
    overflow: hidden;
    position: relative;
    border: 6px solid rgba(255,255,255,0.92);
}

/* Left: media */
.media-area { padding: 0.9rem; display:flex; flex-direction:column; gap:.6rem; }
.media-frame { width:100%; border-radius:10px; overflow:hidden; background:#fff; position:relative; box-shadow:0 14px 36px rgba(31,33,64,0.06); }
.main-image { width:100%; height:360px; object-fit:cover; display:block; background:#f4f4f8; border-radius:8px; }

/* arrows */
.carousel-arrow {
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    width:40px; height:40px; border-radius:50%;
    background: linear-gradient(180deg,#7f58e6,#5f39d6);
    color:#fff; display:flex; align-items:center; justify-content:center;
    cursor:pointer; box-shadow:0 8px 18px rgba(107,75,226,0.14); z-index:6;
}
.carousel-arrow.left { left: 12px; }
.carousel-arrow.right { right: 12px; }

/* thumbnails */
.thumbnail-list { display:flex; gap:.5rem; align-items:center; padding-left:6px; margin-top:.6rem; }
.thumbnail-list .thumb { width:48px; height:48px; border-radius:8px; overflow:hidden; cursor:pointer; border:3px solid transparent; background:#fff; flex:0 0 auto; display:flex; align-items:center; justify-content:center; }
.thumbnail-list .thumb img { width:100%; height:100%; object-fit:cover; display:block; }
.thumbnail-list .thumb.active { border-color: rgba(107,75,226,0.95); transform:translateY(-4px); box-shadow:0 10px 28px rgba(107,75,226,0.12); }

/* Right: info */
.info-area { padding: 1rem; background: linear-gradient(180deg,#f6f5fb,#eef0fb); overflow: hidden; display:flex; flex-direction:column; }
.info-area h3 { font-size:1.35rem; font-weight:700; color:#222236; margin-bottom:.6rem; }
.badges-row { display:flex; gap:.5rem; align-items:center; margin-bottom:.6rem; }
.price-badge { display:inline-block; padding:.35rem .6rem; border-radius:8px; background: linear-gradient(180deg,#8b6be7,#6b4be2); color:#fff; font-weight:700; }
.qty-badge { display:inline-block; padding:.28rem .5rem; border-radius:8px; background:#6b4be2; color:#fff; font-weight:600; }

/* Reviews: make list scrollable (only this part) */
.reviews-section { margin-top: .7rem; display:flex; flex-direction:column; gap:.5rem; }
.reviews-stats { color:#6b6b85; font-size:.95rem; }
.reviews-list {
    max-height: calc(86vh - 480px); /* keeps list usable across heights */
    overflow-y: auto;
    padding-right:6px;
    display:flex;
    flex-direction:column;
    gap:.6rem;
}
.review-card { background:#fff; border-radius:8px; padding:.75rem; border:1px solid rgba(208,208,220,0.6); box-shadow:0 4px 10px rgba(31,33,64,0.03); }
.review-meta { display:flex; justify-content:space-between; align-items:center; margin-bottom:.45rem; }

/* Review form (below the scroll area) */
.review-form-wrapper { margin-top:.5rem; }
.stars { display:flex; gap:.25rem; align-items:center; }
.star { font-size:1.12rem; color:#dcdbe6; cursor:pointer; transition:transform .06s ease, color .12s ease; }
.star.selected { color:#ffce3d; transform:translateY(-2px); }

/* close button */
.modal-close { position:absolute; top:12px; right:12px; width:40px; height:40px; border-radius:50%; background:#fff; display:flex; align-items:center; justify-content:center; cursor:pointer; box-shadow:0 8px 18px rgba(31,33,64,0.08); z-index:10; border:1px solid rgba(0,0,0,0.06); }

@media (max-width:900px) {
    .product-modal { grid-template-columns: 1fr; max-width:94vw; }
    .main-image { height: 260px; }
    .reviews-list { max-height: 28vh; }
}
</style>

<div class="product-show-overlay" id="productModalOverlay" role="dialog" aria-modal="true">
    <div class="product-modal" id="productModal" role="document" aria-label="Detalle del producto">
        <button class="modal-close" id="modalCloseBtn" title="Cerrar" aria-label="Cerrar">
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>

        <!-- LEFT: Media -->
        <div class="media-area">
            <div class="media-frame" style="width:100%;">
                <div class="carousel-arrow left" id="arrow-prev" role="button" aria-label="Anterior"><i class="fas fa-chevron-left"></i></div>
                <div class="carousel-arrow right" id="arrow-next" role="button" aria-label="Siguiente"><i class="fas fa-chevron-right"></i></div>

                <img id="main-product-image" src="{{ $mainImage }}" class="main-image" alt="{{ $product->name ?? 'Producto' }}" loading="lazy">
            </div>

            @if(count($imageUrls) > 1)
                <div class="thumbnail-list" id="thumbnail-list" aria-hidden="false">
                    @foreach($imageUrls as $idx => $url)
                        <div class="thumb {{ $idx === 0 ? 'active' : '' }}" data-index="{{ $idx }}" title="Ver imagen {{ $idx+1 }}">
                            <img src="{{ $url }}" alt="Miniatura {{ $idx+1 }}" loading="lazy">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- RIGHT: Info -->
        <div class="info-area" id="infoArea">
            <h3>{{ $product->name }}</h3>

            <div class="badges-row">
                <span class="price-badge">C$ {{ number_format($product->price ?? 0, 2) }}</span>
                <span class="qty-badge">Cantidad: {{ $product->quantity ?? '-' }}</span>
            </div>

            <p class="mb-2"><strong>Descripción:</strong></p>
            <p class="card-text text-muted">{{ $product->description ?? 'Sin descripción.' }}</p>

            <p class="mt-3"><strong>Categoría:</strong>
                <span class="meta">{{ $product->category->type ?? 'Sin categoría' }}</span>
            </p>

            <hr>

            <div style="margin-bottom:.5rem;">
                @if(Auth::check())
                    <button class="btn btn-primary" id="openReviewBtn">Añadir reseña</button>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
                @endif
            </div>

            <div class="meta mt-1">
                <small>Emprendedor: {{ $product->vendor_name ?? optional($product->user)->name ?? 'Emprendedor' }}</small>
            </div>

            {{-- Reviews area --}}
            <div class="reviews-section" id="reviewsSection">
                <div class="reviews-stats">
                    @php
                        $avg = optional($product->reviews)->avg('rating') ? round(optional($product->reviews)->avg('rating'),1) : 0;
                        $count = optional($product->reviews)->count() ?? 0;
                    @endphp
                    <strong>Reseñas</strong>
                    <div style="margin-top:.35rem; color:#6b6b85;">{{ $avg }} / 5 — {{ $count }} reseña{{ $count>1 ? 's' : '' }}</div>
                </div>

                <div id="reviewsList" class="reviews-list" aria-live="polite" aria-label="Lista de reseñas">
                    @if(isset($product->reviews) && $product->reviews->count())
                        @foreach($product->reviews as $review)
                            <div class="review-card">
                                <div class="review-meta">
                                    <strong>{{ $review->user->name ?? 'Usuario' }}</strong>
                                    <small class="text-muted" style="font-size:.85rem;">{{ optional($review->created_at)->format('d/m/Y') }}</small>
                                </div>
                                <div class="mb-2">
                                    @for($i=1;$i<=5;$i++)
                                        <i class="fa {{ $i <= ($review->rating ?? 0) ? 'fa-star text-warning' : 'fa-star text-secondary' }}"></i>
                                    @endfor
                                </div>
                                <div class="review-comment">{{ $review->comment }}</div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-muted">No hay reseñas aún. Sé el primero en reseñar este producto.</div>
                    @endif
                </div>

                {{-- Form sits BELOW the scrollable list so opening it doesn't shift/lock the list --}}
                <div class="review-form-wrapper">
                    <div id="reviewFormContainer" class="review-block mt-2" style="display:none;">
                        @auth
                        <form action="{{ route('reviews.store') }}" method="POST" id="review-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="rating" id="rating-input" value="">
                            <div class="mb-2">
                                <label class="form-label d-block">Calificación</label>
                                <div class="stars" id="stars">
                                    <span class="star" data-value="1">&#9733;</span>
                                    <span class="star" data-value="2">&#9733;</span>
                                    <span class="star" data-value="3">&#9733;</span>
                                    <span class="star" data-value="4">&#9733;</span>
                                    <span class="star" data-value="5">&#9733;</span>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="comment" class="form-label">Comentario</label>
                                <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Enviar reseña</button>
                                <button type="button" class="btn btn-ghost" id="cancelReviewBtn">Cancelar</button>
                            </div>
                        </form>
                        @else
                            <p class="text-muted">Debes <a href="{{ route('login') }}">iniciar sesión</a> para enviar una reseña.</p>
                        @endauth
                    </div>
                </div>
            </div>
            {{-- end reviews --}}
        </div>
    </div>
</div>

<script>
(function () {
    // Initialize only when modal exists on the page
    const overlay = document.getElementById('productModalOverlay');
    if (!overlay) return;

    const modal = document.getElementById('productModal');
    const closeBtn = document.getElementById('modalCloseBtn');
    const mainImg = document.getElementById('main-product-image');
    const thumbs = document.querySelectorAll('#thumbnail-list .thumb');
    const prev = document.getElementById('arrow-prev');
    const next = document.getElementById('arrow-next');

    // Build imageUrls from thumbnails or fallback to main image
    let imageUrls = [];
    if (thumbs && thumbs.length) {
        thumbs.forEach(t => {
            const img = t.querySelector('img');
            if (img && img.src) imageUrls.push(img.src);
        });
    } else if (mainImg && mainImg.src) {
        imageUrls.push(mainImg.src);
    }

    let currentIndex = 0;
    function showIndex(idx) {
        if (!imageUrls.length) return;
        idx = ((idx % imageUrls.length) + imageUrls.length) % imageUrls.length;
        currentIndex = idx;
        if (mainImg) mainImg.src = imageUrls[idx];
        if (thumbs && thumbs.length) {
            thumbs.forEach(t => t.classList.remove('active'));
            const active = document.querySelector('#thumbnail-list .thumb[data-index="' + idx + '"]');
            if (active) active.classList.add('active');
        }
    }

    // Thumbnails click
    if (thumbs && thumbs.length) {
        thumbs.forEach(t => {
            t.addEventListener('click', function (e) {
                const idx = parseInt(this.getAttribute('data-index') || '0', 10);
                showIndex(idx);
            });
        });
    }

    // Arrows
    if (prev) prev.addEventListener('click', function (e) { e.stopPropagation(); showIndex(currentIndex - 1); });
    if (next) next.addEventListener('click', function (e) { e.stopPropagation(); showIndex(currentIndex + 1); });

    // Keyboard support
    function onKey(e) {
        if (e.key === 'ArrowLeft') showIndex(currentIndex - 1);
        if (e.key === 'ArrowRight') showIndex(currentIndex + 1);
        if (e.key === 'Escape') closeModal();
    }
    document.addEventListener('keydown', onKey);

    // Close modal: restore body scroll and remove wrapper (if injected)
    function closeModal() {
        const wrapper = document.getElementById('clientProductModalWrapper');
        if (wrapper) wrapper.remove();
        else {
            // if modal is direct page access, we hide it (navigation/back recommended)
            overlay.style.display = 'none';
        }
        document.documentElement.style.overflow = '';
        document.body.style.overflow = '';
        document.removeEventListener('keydown', onKey);
    }

    if (closeBtn) closeBtn.addEventListener('click', function (e) { e.preventDefault(); closeModal(); });
    if (overlay) overlay.addEventListener('click', function (e) { if (e.target === overlay) closeModal(); });

    // Reviews logic (form open/hide, stars interaction, scroll handling)
    const reviewsList = document.getElementById('reviewsList');
    const openReviewBtn = document.getElementById('openReviewBtn');
    const reviewFormContainer = document.getElementById('reviewFormContainer');
    const cancelReviewBtn = document.getElementById('cancelReviewBtn');
    const stars = document.querySelectorAll('#stars .star');
    const ratingInput = document.getElementById('rating-input');

    if (openReviewBtn && reviewFormContainer) {
        openReviewBtn.addEventListener('click', function (e) {
            e.preventDefault();
            reviewFormContainer.style.display = 'block';
            // Scroll the reviews area to bottom so the form is visible
            if (reviewsList) reviewsList.scrollTop = reviewsList.scrollHeight;
            setTimeout(() => {
                const ta = document.getElementById('comment');
                if (ta) ta.focus();
            }, 120);
        });
    }

    if (cancelReviewBtn) {
        cancelReviewBtn.addEventListener('click', function (e) {
            e.preventDefault();
            if (reviewFormContainer) reviewFormContainer.style.display = 'none';
            if (ratingInput) ratingInput.value = '';
            if (stars && stars.length) stars.forEach(s => s.classList.remove('selected'));
            const comment = document.getElementById('comment');
            if (comment) comment.value = '';
            // Scroll reviews list to top so the user can continue reading
            if (reviewsList) reviewsList.scrollTop = 0;
        });
    }

    if (stars && stars.length) {
        stars.forEach(s => {
            s.addEventListener('mouseenter', function () {
                const v = parseInt(this.dataset.value, 10);
                stars.forEach(x => x.classList.toggle('selected', parseInt(x.dataset.value, 10) <= v));
            });
            s.addEventListener('mouseleave', function () {
                const current = parseInt(ratingInput.value || 0, 10);
                stars.forEach(x => x.classList.toggle('selected', parseInt(x.dataset.value, 10) <= current));
            });
            s.addEventListener('click', function () {
                const v = parseInt(this.dataset.value, 10);
                if (ratingInput) ratingInput.value = v;
                stars.forEach(x => x.classList.toggle('selected', parseInt(x.dataset.value, 10) <= v));
            });
        });
    }

    // Initialize state
    showIndex(0);
    if (reviewsList) reviewsList.scrollTop = 0;

    // Ensure body scroll is locked when modal is open
    document.documentElement.style.overflow = 'hidden';
    document.body.style.overflow = 'hidden';
})();
</script>
@endsection