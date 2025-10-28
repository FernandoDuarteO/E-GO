// public/js/modules/image-slots.js
// Versión ES module: exporta init() para que el loader llame a la inicialización.
export function init() {
  // Si se llama varias veces, prevenir doble inicialización
  if (window._imageSlotsInitialized) return;
  window._imageSlotsInitialized = true;

  const slotContainers = document.querySelectorAll('.image-slot');

  slotContainers.forEach(slot => {
    slot.addEventListener('click', function (e) {
      if (e.target.closest('.slot-actions')) return;

      const newInput = slot.querySelector('.new-input');
      if (newInput) { newInput.click(); return; }

      const replaceInput = slot.querySelector('.replace-input');
      if (replaceInput) { replaceInput.click(); return; }
    });
  });

  document.addEventListener('change', function (e) {
    // Nuevo archivo en slot vacío
    if (e.target.classList.contains('new-input')) {
      const input = e.target; // mantener referencia para preservar file
      const file = input.files[0];
      if (!file || !file.type.startsWith('image/')) return;

      const reader = new FileReader();
      reader.onload = function (ev) {
        const slot = input.closest('.image-slot');
        if (!slot) return;

        // mantener el input para que el archivo sea enviado con el form
        slot.innerHTML = '';

        const img = document.createElement('img');
        img.src = ev.target.result;
        img.alt = 'Preview';
        slot.appendChild(img);

        const actions = document.createElement('div');
        actions.className = 'slot-actions';
        actions.innerHTML = `
          <button type="button" class="slot-btn slot-replace-btn">✎</button>
          <button type="button" class="slot-btn slot-delete-btn">🗑</button>
        `;
        slot.appendChild(actions);

        const badge = document.createElement('div');
        badge.className = 'slot-replaced-badge d-none';
        badge.textContent = 'Nuevo';
        slot.appendChild(badge);

        input.classList.add('d-none');
        slot.appendChild(input);
        slot.classList.remove('empty');
        slot.classList.add('filled');
      };
      reader.readAsDataURL(file);
      return;
    }

    // Reemplazo de imagen existente
    if (e.target.classList.contains('replace-input')) {
      const input = e.target;
      const file = input.files[0];
      if (!file || !file.type.startsWith('image/')) return;

      const reader = new FileReader();
      reader.onload = function (ev) {
        const slot = input.closest('.image-slot');
        if (!slot) return;
        const img = slot.querySelector('img');
        if (img) img.src = ev.target.result;
        const badge = slot.querySelector('.slot-replaced-badge');
        if (badge) badge.classList.remove('d-none');
        const delCheckbox = slot.querySelector('.delete-checkbox');
        if (delCheckbox) delCheckbox.checked = false;
      };
      reader.readAsDataURL(file);
      return;
    }
  });

  document.addEventListener('click', function (e) {
    // Replace button
    if (e.target.classList.contains('slot-replace-btn')) {
      const slot = e.target.closest('.image-slot');
      if (!slot) return;
      const replaceInput = slot.querySelector('.replace-input');
      const newInput = slot.querySelector('.new-input');
      if (replaceInput) replaceInput.click();
      else if (newInput) newInput.click();
      else {
        const anyInput = slot.querySelector('input[type="file"]');
        if (anyInput) anyInput.click();
      }
      return;
    }

    // Delete button
    if (e.target.classList.contains('slot-delete-btn')) {
      const slot = e.target.closest('.image-slot');
      if (!slot) return;

      const delCheckbox = slot.querySelector('.delete-checkbox');
      if (delCheckbox) {
        delCheckbox.checked = !delCheckbox.checked;
        slot.style.opacity = delCheckbox.checked ? '0.45' : '1';
        return;
      }

      // nueva imagen: limpiar input y restaurar estado "+"
      const fileInput = slot.querySelector('input[type="file"]');
      if (fileInput) {
        try { fileInput.value = ''; } catch (err) {}
      }
      slot.innerHTML = '<span class="plus">+</span><input type="file" accept="image/*" class="d-none new-input" name="media_files[]">';
      slot.classList.remove('filled');
      slot.classList.add('empty');
    }
  });

  // Accessibility: activar con Enter/Space
  document.addEventListener('keydown', function (e) {
    if ((e.key === 'Enter' || e.key === ' ') && document.activeElement && document.activeElement.classList.contains('image-slot')) {
      e.preventDefault();
      document.activeElement.click();
    }
  });
}