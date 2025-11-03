// public/js/modules/perfilEntrepreneur.js
// Módulo para previsualizar avatar y logo en la vista de perfil.
// Correcciones adicionales: evitar que el diálogo de archivos se abra dos veces
// cuando el <label> tiene atributo "for" (nativo ya abre el diálogo).
(function () {
  'use strict';

  function getAvatarPreview() {
    return document.getElementById('avatar-preview');
  }

  function getLogoPreview() {
    return document.getElementById('logo-preview');
  }

  function init() {
    // Profile image input
    var mediaInput = document.getElementById('media_file');
    var mediaName = document.getElementById('media_file_name');

    if (mediaInput) {
      mediaInput.addEventListener('change', function () {
        var file = this.files && this.files[0];
        if (mediaName) mediaName.textContent = file ? file.name : 'Ninguno seleccionado';
        if (!file) return;
        if (!file.type || !file.type.startsWith('image/')) return;

        var reader = new FileReader();
        reader.onload = function (ev) {
          var currentPreview = getAvatarPreview();
          if (currentPreview && currentPreview.tagName && currentPreview.tagName.toLowerCase() === 'img') {
            currentPreview.src = ev.target.result;
            currentPreview.style.borderRadius = '18px';
          } else if (currentPreview) {
            var img = document.createElement('img');
            img.id = 'avatar-preview';
            img.src = ev.target.result;
            img.alt = 'Avatar';
            img.style.width = '100%';
            img.style.height = '100%';
            img.style.objectFit = 'cover';
            img.style.borderRadius = '18px';
            currentPreview.replaceWith(img);
          } else {
            var avatarBlock = document.querySelector('.profile-avatar');
            if (avatarBlock) {
              var img2 = document.createElement('img');
              img2.id = 'avatar-preview';
              img2.src = ev.target.result;
              img2.alt = 'Avatar';
              img2.style.width = '100%';
              img2.style.height = '100%';
              img2.style.objectFit = 'cover';
              img2.style.borderRadius = '18px';
              avatarBlock.appendChild(img2);
            }
          }
        };
        reader.readAsDataURL(file);
      });
    }

    // Business image input (left column)
    var businessInput = document.getElementById('business_media_file');
    var businessName = document.getElementById('business_media_file_name');

    if (businessInput) {
      businessInput.addEventListener('change', function () {
        var file = this.files && this.files[0];
        if (businessName) businessName.textContent = file ? file.name : 'Ninguno seleccionado';
        if (!file) return;
        if (!file.type || !file.type.startsWith('image/')) return;

        var reader = new FileReader();
        reader.onload = function (ev) {
          var currentLogo = getLogoPreview();
          if (currentLogo && currentLogo.tagName && currentLogo.tagName.toLowerCase() === 'img') {
            currentLogo.src = ev.target.result;
            currentLogo.style.borderRadius = '18px';
          } else if (currentLogo) {
            var img = document.createElement('img');
            img.id = 'logo-preview';
            img.src = ev.target.result;
            img.alt = 'Logo';
            img.style.width = '100%';
            img.style.height = '100%';
            img.style.objectFit = 'cover';
            img.style.borderRadius = '18px';
            currentLogo.replaceWith(img);
          } else {
            var businessBlock = document.querySelector('.business-square');
            if (businessBlock) {
              var img2 = document.createElement('img');
              img2.id = 'logo-preview';
              img2.src = ev.target.result;
              img2.alt = 'Logo';
              img2.style.width = '100%';
              img2.style.height = '100%';
              img2.style.objectFit = 'cover';
              img2.style.borderRadius = '18px';
              businessBlock.appendChild(img2);
            }
          }
        };
        reader.readAsDataURL(file);
      });
    }

    // Accessibility & click handling for .file-icon labels
    var fileIcons = document.querySelectorAll('.file-icon');
    if (fileIcons && fileIcons.length) {
      fileIcons.forEach(function (label) {
        // Keydown: trigger input (native click doesn't respond to Enter/Space for labels in some cases)
        label.addEventListener('keydown', function (ev) {
          if (ev.key === ' ' || ev.key === 'Enter' || ev.key === 'Spacebar') {
            ev.preventDefault();
            var forId = label.getAttribute('for');
            if (forId) {
              var input = document.getElementById(forId);
              if (input) input.click();
            } else {
              var childInput = label.querySelector('input[type="file"]');
              if (childInput) childInput.click();
            }
          }
        });

        // Click: only call input.click() if the label does NOT have a "for" attribute.
        // If it has "for", the browser's native label behavior already opens the file dialog;
        // calling input.click() as well causes the dialog to open twice on some platforms.
        label.addEventListener('click', function (ev) {
          var forId = label.getAttribute('for');
          if (forId) {
            // let native behavior run - do not manually call input.click()
            return;
          }
          // If there's no for, try to find an input inside the label and click it.
          var childInput = label.querySelector('input[type="file"]');
          if (childInput) childInput.click();
        });
      });
    }
  }

  // export/init
  if (typeof window !== 'undefined') {
    window.PerfilEntrepreneur = window.PerfilEntrepreneur || {};
    window.PerfilEntrepreneur.init = init;
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();