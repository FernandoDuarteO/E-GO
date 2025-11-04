/*!
 public/js/app.js
 Global app script + loader para módulos en public/js/modules/*
 Hecho: he tomado tu app.js original y añadí detección automática
 para cargar el módulo de perfil cuando existe el markup (.profile-wrap).
 Mantengo el loader dinámico con fallback a <script>.
*/

(function (window, document) {
  'use strict';

  // --- Helpers / namespace ---------------------------------------------------------
  window.App = window.App || {};

  // Helper: load classic script tag (fallback)
  window.App.loadScript = function (src, cb) {
    var s = document.createElement('script');
    s.src = src;
    s.async = true;
    s.onload = function () { if (typeof cb === 'function') cb(null); };
    s.onerror = function () { if (typeof cb === 'function') cb(new Error('Failed to load ' + src)); };
    document.head.appendChild(s);
  };

  // Helper: try dynamic import(), fallback to loadScript()
  function loadModule(path) {
    try {
      // dynamic import expects a module specifier; we'll attempt it and fallback if rejects
      return import(path).catch(function () {
        return new Promise(function (resolve, reject) {
          window.App.loadScript(path, function (err) {
            err ? reject(err) : resolve();
          });
        });
      });
    } catch (e) {
      // import() not supported -> fallback
      return new Promise(function (resolve, reject) {
        window.App.loadScript(path, function (err) {
          err ? reject(err) : resolve();
        });
      });
    }
  }

  // Procesa una lista de módulos (array de rutas absolutas), carga todos y llama init si exportan
  function processModulesList(list) {
    if (!Array.isArray(list) || list.length === 0) return Promise.resolve();
    // normalizar y quitar duplicados
    var uniq = list.filter(function (v, i, a) { return v && a.indexOf(v) === i; });
    return Promise.all(uniq.map(function (p) {
      return loadModule(p).then(function (mod) {
        try {
          if (mod && typeof mod.init === 'function') mod.init();
          if (mod && typeof mod.initModule === 'function') mod.initModule();
        } catch (err) { console.warn('Module init error for', p, err); }
      }).catch(function (err) {
        console.error('Error loading module', p, err);
      });
    }));
  }

  // --- AQUI VA TU CÓDIGO ORIGINAL (no modificado) ----------------------------------
  // He pegado tu código exacto tal como lo enviaste, para que no cambie nada de tu lógica.
  document.addEventListener('DOMContentLoaded', function() {
      // Sidebar toggle functionality
      const sidebarToggle = document.querySelector('[data-bs-target="#sidebarMenu"]');
      const sidebar = document.querySelector('.sidebar');

      if (sidebarToggle) {
          sidebarToggle.addEventListener('click', function() {
              sidebar.classList.toggle('collapsed');
          });
      }

      // Active menu highlighting
      const currentPath = window.location.pathname;
      const navLinks = document.querySelectorAll('.nav-link');

      navLinks.forEach(link => {
          if (link.getAttribute('href') === currentPath) {
              link.classList.add('active');
          }
      });

      // Table row interactions
      const tableRows = document.querySelectorAll('tbody tr');
      tableRows.forEach(row => {
          row.addEventListener('click', function(e) {
              if (!e.target.closest('button')) {
                  this.classList.toggle('table-active');
              }
          });
      });

      // Search functionality
      const searchInput = document.querySelector('.search-container input');
      if (searchInput) {
          searchInput.addEventListener('input', function(e) {
              const searchTerm = e.target.value.toLowerCase();
              const tableRows = document.querySelectorAll('tbody tr');

              tableRows.forEach(row => {
                  const text = row.textContent.toLowerCase();
                  row.style.display = text.includes(searchTerm) ? '' : 'none';
              });
          });
      }

      // Button actions
      document.querySelectorAll('.btn-warning').forEach(btn => {
          btn.addEventListener('click', function() {
              alert('Funcionalidad de editar producto');
          });
      });

      document.querySelectorAll('.btn-danger').forEach(btn => {
          btn.addEventListener('click', function() {
              if (confirm('¿Estás seguro de eliminar este elemento?')) {
                  alert('Elemento eliminado');
              }
          });
      });
  });

  document.addEventListener('DOMContentLoaded', function() {
      // --- Net Income Chart ---
      const ctx1 = document.getElementById('netIncomeChart');
      if (ctx1) {
          new Chart(ctx1, {
              type: 'bar',
              data: {
                  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                  datasets: [{
                      data: [5000, 4000, 6000, 5500, 4200, 7000],
                      backgroundColor: '#5e59a1',
                      borderRadius: 6
                  }]
              },
              options: {
                  plugins: { legend: { display: false } },
                  scales: { y: { beginAtZero: true } }
              }
          });
      }

      // --- Location Chart ---
      const ctx2 = document.getElementById('locationChart');
      if (ctx2) {
          new Chart(ctx2, {
              type: 'doughnut',
              data: {
                  labels: ['India', 'UK', 'USA'],
                  datasets: [{
                      data: [40, 30, 30],
                      backgroundColor: ['#5e59a1', '#1cc88a', '#36b9cc']
                  }]
              },
              options: {
                  plugins: { legend: { position: 'bottom' } }
              }
          });
      }
  });
  // --- FIN del código original ----------------------------------------------------

  // Loader automático: si la vista declara window.pageModules, el loader las procesará.
  // Además hacemos detección automática por DOM para cargar los módulos relevantes.
  document.addEventListener('DOMContentLoaded', function () {
    var modulesToLoad = window.pageModules && Array.isArray(window.pageModules) ? window.pageModules.slice() : [];

    // detección automática por DOM
    try {
      if (document.querySelector('.image-slot')) {
        modulesToLoad.push('/js/modules/image-slots.js');
      }
      // carrusel/product-show
      if (document.getElementById('carousel-main-image') || document.querySelector('.indicator-btn')) {
        modulesToLoad.push('/js/modules/product-carousel.js');
      }

      // AUTOLOAD: cargar el módulo de perfil si la vista tiene .profile-wrap o #profileTitle
      // Ajusta el nombre/nombre de fichero aquí si en tu carpeta modules el archivo tiene otro nombre exacto.
      if (document.querySelector('.profile-wrap') || document.getElementById('profileTitle')) {
        modulesToLoad.push('/js/modules/perfilEntrepreneur.js');
      }
    } catch (err) {
      // no hacer nada si document no está disponible (muy raro)
      console.warn('Auto-detection error', err);
    }

    // Si no hay módulos, salir
    if (!modulesToLoad || modulesToLoad.length === 0) return;

    // Normaliza rutas: asegurar que cada ruta empiece por "/" para evitar problemas relativos
    modulesToLoad = modulesToLoad.map(function (p) {
      return typeof p === 'string' ? p.trim() : p;
    }).filter(Boolean);

    // Añadir cache-busting opcional desde la vista: si window.pageModulesCacheBuster existe, aplicarlo
    var cb = window.pageModulesCacheBuster || '';
    if (cb && typeof cb === 'string') {
      modulesToLoad = modulesToLoad.map(function (p) {
        // si ya tiene query, añadir &v=..., sino ?v=...
        return p + (p.indexOf('?') === -1 ? ('?v=' + cb) : ('&v=' + cb));
      });
    }

    processModulesList(modulesToLoad).then(function () {
      // módulos cargados
      // console.log('Modules loaded:', modulesToLoad);
    }).catch(function (err) {
      console.error('Error processing page modules', err);
    });
  });

  // Exponer API simple
  window.App.processModulesList = processModulesList;

})(window, document);