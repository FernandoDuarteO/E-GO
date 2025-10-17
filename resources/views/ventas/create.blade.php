@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/modules/ventas.css') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="container-fluid py-4">
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1><i class="fas fa-plus-circle me-2"></i>Nueva Venta</h1>
                <p class="lead mb-0">Registrar nueva venta en el sistema</p>
            </div>
            <a href="{{ route('ventas.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver al Historial
            </a>
        </div>
    </div>

    <div class="content-section">
        <!-- Formulario de Nueva Venta -->
        <div class="form-section">
            <form class="row g-3 needs-validation" novalidate id="salesForm">
                <div class="col-md-6">
                    <label for="customerName" class="form-label">Cliente</label>
                    <input type="text" class="form-control" id="customerName" required>
                    <div class="invalid-feedback">
                        Por favor ingrese el nombre del cliente.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="product" class="form-label">Producto</label>
                    <select class="form-select" id="product" required>
                        <option value="" selected disabled>Seleccione un producto</option>
                        <option value="1">Laptop Dell XPS 13</option>
                        <option value="2">iPhone 14 Pro</option>
                        <option value="3">Samsung Galaxy S23</option>
                        <option value="4">MacBook Pro 16"</option>
                        <option value="5">iPad Air</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor seleccione un producto.
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="quantity" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" id="quantity" min="1" required>
                    <div class="invalid-feedback">
                        Por favor ingrese una cantidad válida (mínimo 1).
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="price" class="form-label">Precio Unitario ($)</label>
                    <input type="number" class="form-control" id="price" min="0.01" step="0.01" required>
                    <div class="invalid-feedback">
                        Por favor ingrese un precio válido.
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="total" class="form-label">Total ($)</label>
                    <input type="text" class="form-control" id="total" readonly>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-save me-1"></i>Registrar Venta</button>
                    <button class="btn btn-outline-secondary" type="button" id="resetForm"><i class="fas fa-redo me-1"></i>Limpiar</button>
                    <a href="{{ route('ventas.index') }}" class="btn btn-outline-danger">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmación de Venta</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro de que desea registrar esta venta?</p>
                <div class="sale-details">
                    <p><strong>Cliente:</strong> <span id="modalCustomer"></span></p>
                    <p><strong>Producto:</strong> <span id="modalProduct"></span></p>
                    <p><strong>Cantidad:</strong> <span id="modalQuantity"></span></p>
                    <p><strong>Precio Unitario:</strong> $<span id="modalPrice"></span></p>
                    <p><strong>Total:</strong> $<span id="modalTotal"></span></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmSale">Confirmar Venta</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Inicializar tooltips de Bootstrap
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Calcular total automáticamente
        document.getElementById('quantity').addEventListener('input', calculateTotal);
        document.getElementById('price').addEventListener('input', calculateTotal);
        
        // Configurar formulario
        const form = document.getElementById('salesForm');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            event.stopPropagation();
            
            if (form.checkValidity()) {
                // Mostrar modal de confirmación
                showConfirmationModal();
            }
            
            form.classList.add('was-validated');
        }, false);
        
        // Botón de reset
        document.getElementById('resetForm').addEventListener('click', function() {
            form.reset();
            form.classList.remove('was-validated');
            document.getElementById('total').value = '';
        });
        
        // Confirmar venta en el modal
        document.getElementById('confirmSale').addEventListener('click', function() {
            // Aquí iría la lógica para guardar la venta
            alert('Venta registrada exitosamente');
            
            // Cerrar modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('confirmationModal'));
            modal.hide();
            
            // Redirigir al historial
            window.location.href = "{{ route('ventas.index') }}";
        });
    }, false);

    // Función para calcular el total
    function calculateTotal() {
        const quantity = document.getElementById('quantity').value;
        const price = document.getElementById('price').value;
        
        if (quantity && price) {
            const total = (parseFloat(quantity) * parseFloat(price)).toFixed(2);
            document.getElementById('total').value = total;
        } else {
            document.getElementById('total').value = '';
        }
    }

    // Función para mostrar el modal de confirmación
    function showConfirmationModal() {
        document.getElementById('modalCustomer').textContent = document.getElementById('customerName').value;
        
        const productSelect = document.getElementById('product');
        const productText = productSelect.options[productSelect.selectedIndex].text;
        document.getElementById('modalProduct').textContent = productText;
        
        document.getElementById('modalQuantity').textContent = document.getElementById('quantity').value;
        document.getElementById('modalPrice').textContent = document.getElementById('price').value;
        document.getElementById('modalTotal').textContent = document.getElementById('total').value;
        
        const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        modal.show();
    }
</script>
@endsection