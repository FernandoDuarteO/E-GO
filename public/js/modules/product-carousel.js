// public/js/modules/product-carousel.js
// Versión ES module: exporta init() para que el loader la ejecute.
export function init() {
  if (window._productCarouselInitialized) return;
  window._productCarouselInitialized = true;

  const mainImg = document.getElementById('carousel-main-image');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  const indicatorBtns = Array.from(document.querySelectorAll('.indicator-btn'));

  // Construir array de imágenes leyendo las miniaturas si existen
  let images = [];

  if (indicatorBtns.length > 0) {
    images = indicatorBtns.map(btn => {
      const img = btn.querySelector('img');
      return img ? img.src : null;
    }).filter(Boolean);
  } else if (mainImg) {
    // fallback: tomar la src del main image (caso 1 imagen o placeholder)
    const src = mainImg.getAttribute('src');
    if (src) images = [src];
  }

  if (!images || images.length <= 1) return; // nada que hacer

  let idx = 0;

  function setImage(i, focus = false) {
    idx = (i + images.length) % images.length;
    if (mainImg) mainImg.src = images[idx];
    indicatorBtns.forEach((b, k) => b.classList.toggle('active', k === idx));
    if (focus && indicatorBtns[idx]) indicatorBtns[idx].focus();
  }

  if (prevBtn) prevBtn.addEventListener('click', () => setImage(idx - 1));
  if (nextBtn) nextBtn.addEventListener('click', () => setImage(idx + 1));

  indicatorBtns.forEach(btn => {
    btn.addEventListener('click', function () {
      const i = parseInt(this.getAttribute('data-index'), 10);
      if (!Number.isNaN(i)) setImage(i, true);
    });
    btn.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        this.click();
      }
    });
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'ArrowLeft') setImage(idx - 1);
    if (e.key === 'ArrowRight') setImage(idx + 1);
  });

  // inicializar en 0 (mantiene el comportamiento original)
  setImage(0);
}