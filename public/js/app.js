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
