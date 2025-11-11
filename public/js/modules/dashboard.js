document.addEventListener('DOMContentLoaded', function () {
  // Paleta usada en JS (coincide con CSS)
  const COLOR_PURPLE = '#7764e4';
  const COLOR_PURPLE_SOFT = '#e9e5fb';
  const COLOR_YELLOW = '#f3c11a';

  const monthsFull = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
  const salesByMonth = [120, 150, 170, 210, 260, 310, 360, 420, 480, 540, 600, 660];
  const earningsByMonth = salesByMonth.map(v => Math.round(v * (15 + Math.random()*10)));

  const totalSales = salesByMonth.reduce((a,b)=>a+b,0);
  const totalStock = 842;
  const totalEarnings = earningsByMonth.reduce((a,b)=>a+b,0);

  const topProducts = [
    { id:1, name:'Kit Emprende PRO', sold: 320, img:'https://picsum.photos/seed/p1/80/80' },
    { id:2, name:'Curso Marketing', sold: 280, img:'https://picsum.photos/seed/p2/80/80' },
    { id:3, name:'Plantilla E-GO', sold: 200, img:'https://picsum.photos/seed/p3/80/80' },
    { id:4, name:'Asesoría 1:1', sold: 150, img:'https://picsum.photos/seed/p4/80/80' },
    { id:5, name:'Pack Redes', sold: 130, img:'https://picsum.photos/seed/p5/80/80' },
  ];

  // Counters más compactos
  animateCount('totalSales', totalSales);
  animateCount('totalStock', totalStock);
  animateCount('totalEarnings', totalEarnings, {prefix:'$'});

  // Sparklines (más pequeñas)
  createSpark('sparkSales', salesByMonth, COLOR_PURPLE);
  createSpark('sparkStock', [50,60,55,70,80,90,85,95,100,110,105,120], COLOR_YELLOW);
  createSpark('sparkEarnings', earningsByMonth, COLOR_YELLOW);

  // Chart mensual
  const ctx = document.getElementById('monthlyChart').getContext('2d');
  const monthlyChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: monthsFull,
      datasets: [
        {
          type: 'bar',
          label: 'Ventas (unidades)',
          data: salesByMonth,
          backgroundColor: COLOR_PURPLE,
          borderRadius: 6,
          barThickness: 14
        },
        {
          type: 'line',
          label: 'Ganancias ($)',
          data: earningsByMonth,
          borderColor: COLOR_YELLOW,
          backgroundColor: hexToRgba(COLOR_YELLOW,0.12),
          tension: 0.35,
          pointRadius: 3,
          yAxisID: 'y1',
          borderWidth: 2
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      interaction: { mode: 'index', intersect: false },
      scales: {
        y: {
          beginAtZero: true,
          position: 'left',
          grid: { color: 'rgba(66,62,114,0.06)' }
        },
        y1: {
          beginAtZero: true,
          position: 'right',
          grid: { display: false },
          ticks: { callback: function(value){ return '$' + value; } }
        },
        x: { grid: { display: false } }
      },
      plugins: {
        legend: { position: 'top' },
        tooltip: {
          callbacks: {
            label: function(context) {
              if (context.dataset.type === 'line') return context.dataset.label + ': $' + context.formattedValue;
              return context.dataset.label + ': ' + context.formattedValue;
            }
          }
        }
      }
    }
  });

  // Rango botones
  document.querySelectorAll('[data-range]').forEach(btn => {
    btn.addEventListener('click', function () {
      document.querySelectorAll('[data-range]').forEach(b=>b.classList.remove('active'));
      this.classList.add('active');
      const n = parseInt(this.dataset.range,10);
      updateMonthlyRange(n);
    });
  });

  function updateMonthlyRange(monthsCount){
    const lastN = monthsFull.slice(-monthsCount);
    const sales = salesByMonth.slice(-monthsCount);
    const earnings = earningsByMonth.slice(-monthsCount);

    monthlyChart.data.labels = lastN;
    monthlyChart.data.datasets[0].data = sales;
    monthlyChart.data.datasets[1].data = earnings;
    monthlyChart.update();
  }

  populateTopProducts(topProducts);

  /* ----- Funciones auxiliares ----- */
  function animateCount(elementId, endValue, opts = {}) {
    const el = document.getElementById(elementId);
    if(!el) return;
    const prefix = opts.prefix || '';
    const duration = opts.duration || 900;
    const start = 0;
    const range = endValue - start;
    let current = start;
    const increment = Math.max(1, Math.round(range / (duration / 16)));
    const timer = setInterval(() => {
      current += increment;
      if (current >= endValue) {
        current = endValue;
        clearInterval(timer);
      }
      el.textContent = prefix + numberWithCommas(current);
    }, 16);
  }

  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  function createSpark(canvasId, data, color) {
    const ctx = document.getElementById(canvasId)?.getContext('2d');
    if(!ctx) return;
    new Chart(ctx, {
      type: 'line',
      data: { labels: data.map((_,i)=>i+1), datasets: [{ data, borderColor: color, backgroundColor: hexToRgba(color,0.12), fill: true, tension: 0.3, pointRadius:0 }]},
      options: { plugins: { legend:{display:false} }, scales: { x:{ display:false }, y:{ display:false } }, elements: { line: { borderWidth: 2 } }, maintainAspectRatio: false }
    });
  }

  function hexToRgba(hex, alpha) {
    const h = hex.replace('#','');
    const bigint = parseInt(h,16);
    const r = (bigint >> 16) & 255;
    const g = (bigint >> 8) & 255;
    const b = bigint & 255;
    return `rgba(${r},${g},${b},${alpha})`;
  }

  function populateTopProducts(list) {
    const ul = document.getElementById('topProductsList');
    ul.innerHTML = '';
    const maxSold = Math.max(...list.map(p=>p.sold));
    list.forEach((p) => {
      const li = document.createElement('li');

      const img = document.createElement('img');
      img.src = p.img;
      img.alt = p.name;
      img.className = 'product-thumb';

      const info = document.createElement('div');
      info.style.flex = '1';

      const titleRow = document.createElement('div');
      titleRow.className = 'd-flex justify-content-between align-items-center';
      titleRow.innerHTML = `<strong style="font-size:0.95rem">${p.name}</strong><small class="text-muted"> ${p.sold} vendidos</small>`;

      const progressWrap = document.createElement('div');
      progressWrap.className = 'mt-2';
      const pct = Math.round((p.sold / maxSold) * 100);
      progressWrap.innerHTML = `
        <div class="progress" style="height:7px; border-radius:7px; background:rgba(147,143,194,0.08);">
          <div class="progress-bar" role="progressbar" style="width: ${pct}%; background: linear-gradient(90deg, ${COLOR_PURPLE}, ${COLOR_PURPLE});" aria-valuenow="${pct}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      `;

      info.appendChild(titleRow);
      info.appendChild(progressWrap);

      li.appendChild(img);
      li.appendChild(info);

      ul.appendChild(li);
    });
  }

});
