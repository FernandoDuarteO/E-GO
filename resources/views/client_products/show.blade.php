@php
    // Esta vista devuelve SOLO el fragmento modal (sin layout) para inyección por AJAX.
    // Normalizamos posibles relaciones de imágenes y construimos $imageUrls.
    $imageCollection = collect();

    if (isset($product->productImages) && $product->productImages instanceof \Illuminate\Support\Collection && $product->productImages->count()) {
        $imageCollection = $product->productImages;
    } elseif (isset($product->product_images) && $product->product_images instanceof \Illuminate\Support\Collection && $product->product_images->count()) {
        $imageCollection = $product->product_images;
    } elseif (isset($product->images) && $product->images instanceof \Illuminate\Support\Collection && $product->images->count()) {
        $imageCollection = $product->images;
    }

    $imageUrls = [];
    foreach ($imageCollection as $img) {
        $val = $img->file_path ?? $img->path ?? $img->url ?? null;
        if ($val) {
            $imageUrls[] = preg_match('/^https?:\\/\\//i', $val) ? $val : asset('storage/' . ltrim($val, '/'));
        }
    }

    if (empty($imageUrls) && !empty($product->media_file)) {
        $val = $product->media_file;
        $maybe = @json_decode($val, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($maybe)) {
            foreach ($maybe as $m) {
                if ($m) $imageUrls[] = (preg_match('/^https?:\\/\\//i', $m) ? $m : asset('storage/' . ltrim($m, '/')));
            }
        } else {
            $imageUrls[] = (preg_match('/^https?:\\/\\//i', $val) ? $val : asset('storage/' . ltrim($val, '/')));
        }
    }

    if (empty($imageUrls)) {
        $imageUrls[] = 'https://via.placeholder.com/900x700?text=Sin+imagen';
    }

    $mainImage = $imageUrls[0] ?? null;
    $pid = $product->id ?? '0';
@endphp

<div id="clientProductModalWrapper" data-pid="{{ $pid }}">
    <div id="productModalOverlay" role="dialog" aria-modal="true"
         style="position:fixed;inset:0;display:flex;align-items:center;justify-content:center;padding:2rem;background:rgba(24,22,30,0.36);backdrop-filter:blur(3px);z-index:200000;">
        <div id="productModal" role="document" aria-label="Detalle del producto"
             style="width:100%;max-width:920px;max-height:calc(100vh - 72px);background:linear-gradient(180deg,#fff,#fbf9ff);border-radius:12px;display:grid;grid-template-columns:1fr 360px;gap:1rem;box-shadow:0 36px 70px rgba(15,15,40,0.40);overflow:hidden;border:6px solid rgba(255,255,255,0.92);position:relative;">

            <!-- Close button (inline fallback + data-action) -->
            <button id="modalCloseBtn" type="button" aria-label="Cerrar" data-action="close"
                    onclick="(function(){ const w=document.getElementById('clientProductModalWrapper'); if(w) w.remove(); document.documentElement.style.overflow=''; document.body.style.overflow=''; })()"
                    style="position:absolute;top:12px;right:12px;width:44px;height:44px;border-radius:50%;background:#fff;border:1px solid rgba(0,0,0,0.06);box-shadow:0 8px 18px rgba(31,33,64,0.08);cursor:pointer;z-index:200010;pointer-events:auto;">
                <span aria-hidden="true" style="font-weight:700;font-size:18px;line-height:1;pointer-events:none;">×</span>
            </button>

            <!-- LEFT: media -->
            <div class="media-area" style="padding:1rem;display:flex;flex-direction:column;gap:.6rem;">
                <div class="media-frame" style="width:100%;border-radius:10px;overflow:hidden;background:#fff;position:relative;box-shadow:0 14px 36px rgba(31,33,64,0.06);">
                    <!-- Prev: inline onclick (reliable even after innerHTML) -->
                    <button id="arrowPrev" data-action="prev" aria-label="Anterior" type="button"
                            onclick="(function(btn){ const modal=btn.closest('#productModal'); if(!modal) return; const thumbs=Array.from(modal.querySelectorAll('.thumb')); if(!thumbs.length) return; const main=modal.querySelector('#mainProductImage'); let idx=thumbs.findIndex(t=>t.classList.contains('active')); if(idx===-1) idx=0; const newIdx = (idx<=0 ? thumbs.length-1 : idx-1); thumbs.forEach((t,i)=>{ t.classList.toggle('active', i===newIdx); t.style.borderColor = i===newIdx ? 'rgba(107,75,226,0.95)' : 'transparent'; }); const img = thumbs[newIdx].querySelector('img'); if(img && main) main.src = img.src; })(this);"
                            style="position:absolute;top:50%;left:12px;transform:translateY(-50%);width:44px;height:44px;border-radius:50%;background:linear-gradient(180deg,#7f58e6,#5f39d6);color:#fff;border:none;z-index:200005;cursor:pointer;pointer-events:auto;">
                        <i class="fas fa-chevron-left" aria-hidden="true" style="pointer-events:none;"></i>
                    </button>

                    <!-- Next: inline onclick -->
                    <button id="arrowNext" data-action="next" aria-label="Siguiente" type="button"
                            onclick="(function(btn){ const modal=btn.closest('#productModal'); if(!modal) return; const thumbs=Array.from(modal.querySelectorAll('.thumb')); if(!thumbs.length) return; const main=modal.querySelector('#mainProductImage'); let idx=thumbs.findIndex(t=>t.classList.contains('active')); if(idx===-1) idx=0; const newIdx = (idx+1) % thumbs.length; thumbs.forEach((t,i)=>{ t.classList.toggle('active', i===newIdx); t.style.borderColor = i===newIdx ? 'rgba(107,75,226,0.95)' : 'transparent'; }); const img = thumbs[newIdx].querySelector('img'); if(img && main) main.src = img.src; })(this);"
                            style="position:absolute;top:50%;right:12px;transform:translateY(-50%);width:44px;height:44px;border-radius:50%;background:linear-gradient(180deg,#7f58e6,#5f39d6);color:#fff;border:none;z-index:200005;cursor:pointer;pointer-events:auto;">
                        <i class="fas fa-chevron-right" aria-hidden="true" style="pointer-events:none;"></i>
                    </button>

                    <img id="mainProductImage" src="{{ $mainImage }}" alt="{{ $product->name ?? 'Producto' }}" loading="lazy"
                         style="width:100%;height:380px;object-fit:cover;display:block;border-radius:8px;">
                </div>

                <!-- Thumbnails -->
                @if(count($imageUrls) > 1)
                    <div id="thumbnailList" class="thumbnail-list" style="display:flex;gap:.5rem;align-items:center;padding-left:6px;margin-top:.6rem;">
                        @foreach($imageUrls as $idx => $url)
                            <button class="thumb {{ $idx === 0 ? 'active' : '' }}" data-index="{{ $idx }}" type="button"
                                    onclick="(function(btn){ const modal=btn.closest('#productModal'); if(!modal) return; const main=modal.querySelector('#mainProductImage'); const thumbs=Array.from(modal.querySelectorAll('.thumb')); const idx=parseInt(btn.getAttribute('data-index')||'0',10); thumbs.forEach((t,i)=>{ t.classList.toggle('active', i===idx); t.style.borderColor = i===idx ? 'rgba(107,75,226,0.95)' : 'transparent'; }); const img=btn.querySelector('img'); if(img && main) main.src = img.src; })(this);"
                                    style="width:48px;height:48px;border-radius:8px;overflow:hidden;border:3px solid {{ $idx===0 ? 'rgba(107,75,226,0.95)' : 'transparent' }};background:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;pointer-events:auto;">
                                <img src="{{ $url }}" alt="Miniatura {{ $idx + 1 }}" loading="lazy" style="width:100%;height:100%;object-fit:cover;display:block;pointer-events:none;">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- RIGHT: info -->
            <div class="info-area" style="padding:1rem;background:linear-gradient(180deg,#f6f5fb,#eef0fb);overflow:auto;">
                <h3 style="font-size:1.35rem;font-weight:700;color:#222236;margin-bottom:.6rem;">{{ $product->name }}</h3>

                <div style="display:flex;gap:.5rem;align-items:center;margin-bottom:.6rem;">
                    <span style="display:inline-block;padding:.35rem .6rem;border-radius:8px;background:linear-gradient(180deg,#8b6be7,#6b4be2);color:#fff;font-weight:700;">C$ {{ number_format($product->price ?? 0, 2) }}</span>
                    <span style="display:inline-block;padding:.28rem .5rem;border-radius:8px;background:#6b4be2;color:#fff;font-weight:600;">Cantidad: {{ $product->quantity ?? '-' }}</span>
                </div>

                <p style="margin:0 .0 .35rem 0;"><strong>Descripción:</strong></p>
                <p class="card-text text-muted" style="color:#6b6b85;line-height:1.45;">{{ $product->description ?? 'Sin descripción.' }}</p>

                <hr style="margin:.6rem 0;border-color:rgba(34,34,52,0.06);">

                <div id="reviewsList" style="margin-top:.6rem;">
                    @if(isset($product->reviews) && $product->reviews->count())
                        @foreach($product->reviews as $review)
                            <div class="review-card" style="background:#fff;border-radius:8px;padding:.75rem;margin-bottom:.6rem;border:1px solid rgba(208,208,220,0.6);box-shadow:0 4px 10px rgba(31,33,64,0.03);">
                                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:.45rem;">
                                    <strong>{{ $review->user->name ?? 'Usuario' }}</strong>
                                    <small class="text-muted" style="font-size:.85rem;">{{ optional($review->created_at)->format('d/m/Y') }}</small>
                                </div>
                                <div style="margin-bottom:.5rem;">
                                    @for($i=1;$i<=5;$i++)
                                        <i class="fa {{ $i <= ($review->rating ?? 0) ? 'fa-star text-warning' : 'fa-star text-secondary' }}"></i>
                                    @endfor
                                </div>
                                <div>{{ $review->comment }}</div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-muted">No hay reseñas aún. Sé el primero en reseñar este producto.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    // Idempotent initializer: attaches keyboard and overlay handlers.
    function attachHandlers(wrapper) {
        const root = (wrapper && wrapper.nodeType) ? wrapper : document.getElementById('clientProductModalWrapper');
        if (!root) return;
        const modal = root.querySelector('#productModal');
        if (!modal) return;
        if (modal.dataset.inited === '1') return;
        modal.dataset.inited = '1';

        // lock scroll
        document.documentElement.style.overflow = 'hidden';
        document.body.style.overflow = 'hidden';

        const overlay = root.querySelector('#productModalOverlay');
        const closeBtn = root.querySelector('#modalCloseBtn') || root.querySelector('[data-action="close"]');
        const thumbs = Array.from(root.querySelectorAll('.thumb'));
        const main = root.querySelector('#mainProductImage');
        const prev = root.querySelector('[data-action="prev"]');
        const next = root.querySelector('[data-action="next"]');

        // keyboard support
        function showIndex(i) {
            if (!thumbs.length || !main) return;
            i = ((i % thumbs.length) + thumbs.length) % thumbs.length;
            const img = thumbs[i].querySelector('img');
            if (img) main.src = img.src;
            thumbs.forEach((t, idx) => {
                t.classList.toggle('active', idx === i);
                t.style.borderColor = idx === i ? 'rgba(107,75,226,0.95)' : 'transparent';
            });
        }

        function onKey(e) {
            if (e.key === 'ArrowLeft') {
                const idx = thumbs.findIndex(t => t.classList.contains('active'));
                showIndex(idx <= 0 ? thumbs.length - 1 : idx - 1);
            }
            if (e.key === 'ArrowRight') {
                const idx = thumbs.findIndex(t => t.classList.contains('active'));
                showIndex((idx === -1 ? 0 : (idx + 1)) % thumbs.length);
            }
            if (e.key === 'Escape') cleanup();
        }
        document.addEventListener('keydown', onKey);

        // close behavior
        function cleanup() {
            try {
                const w = document.getElementById('clientProductModalWrapper');
                if (w) w.remove();
            } finally {
                document.documentElement.style.overflow = '';
                document.body.style.overflow = '';
                document.removeEventListener('keydown', onKey);
            }
        }

        if (closeBtn) closeBtn.addEventListener('click', function (e) { e.preventDefault(); e.stopPropagation(); cleanup(); });

        if (overlay) overlay.addEventListener('click', function (e) { if (e.target === overlay) cleanup(); });

        // also observe removal to cleanup keyboard
        const observer = new MutationObserver(function (mutations) {
            for (const m of mutations) {
                for (const node of Array.from(m.removedNodes || [])) {
                    if (node && node.id === 'clientProductModalWrapper') {
                        document.documentElement.style.overflow = '';
                        document.body.style.overflow = '';
                        document.removeEventListener('keydown', onKey);
                        observer.disconnect();
                        return;
                    }
                }
            }
        });
        observer.observe(document.body, { childList: true });

        // initial focus
        if (closeBtn) { closeBtn.setAttribute('tabindex', '0'); closeBtn.focus(); }
    }

    window.initClientProductModal = window.initClientProductModal || function (wrapper) {
        attachHandlers(wrapper);
    };

    // auto attach if fragment already in DOM
    try {
        const wrapper = document.getElementById('clientProductModalWrapper');
        if (wrapper) attachHandlers(wrapper);
    } catch (err) {
        console.error('init modal error', err);
    }
})();
</script>