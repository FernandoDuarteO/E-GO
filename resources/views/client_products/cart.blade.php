@extends('layouts.clients')

@section('content')
@php
    // $cart: array of items with keys id,name,price,quantity,subtotal,image,vendor
@endphp

<div class="container mt-4">
    <h2>Tu carrito</h2>

    <div id="cartWrapper">
        @if(empty($cart) || count($cart) === 0)
            <div class="alert alert-info">Tu carrito está vacío.</div>
        @else
            <div class="cart-list">
                @foreach($cart as $item)
                <div class="cart-item" data-id="{{ $item['id'] }}" style="display:flex;align-items:center;gap:1rem;padding:12px;border:1px solid #eee;border-radius:8px;margin-bottom:.75rem;">
                    <img src="{{ $item['image'] ? (preg_match('/^https?:\\/\\//', $item['image']) ? $item['image'] : asset('storage/' . ltrim($item['image'], '/'))) : 'https://via.placeholder.com/120' }}" alt="" style="width:120px;height:80px;object-fit:cover;border-radius:6px;">
                    <div style="flex:1;">
                        <strong>{{ $item['name'] }}</strong><br>
                        <small class="text-muted">{{ $item['vendor'] }}</small>
                    </div>

                    <div style="display:flex;flex-direction:column;align-items:flex-end;gap:.4rem;">
                        <div>
                            <button class="btn btn-sm btn-outline-secondary remove-item" data-id="{{ $item['id'] }}">Eliminar</button>
                        </div>
                        <div style="display:flex;gap:.5rem;align-items:center;">
                            <button class="btn btn-sm btn-light qty-decrease" data-id="{{ $item['id'] }}">-</button>
                            <input type="number" class="form-control form-control-sm qty-input" data-id="{{ $item['id'] }}" value="{{ $item['quantity'] }}" min="1" style="width:60px;text-align:center;">
                            <button class="btn btn-sm btn-light qty-increase" data-id="{{ $item['id'] }}">+</button>
                        </div>
                        <div><strong id="subtotal-{{ $item['id'] }}">C$ {{ number_format($item['subtotal'], 2) }}</strong></div>
                    </div>
                </div>
                @endforeach
            </div>

            <div style="margin-top:1rem;display:flex;justify-content:flex-end;align-items:center;gap:2rem;">
                <div><strong>Total:</strong> C$ <span id="cartTotal">{{ number_format($total ?? 0, 2) }}</span></div>
                <a href="#" id="checkoutBtn" class="btn btn-primary">Enviar pedido</a>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    async function postJson(url, data, method = 'POST') {
        const res = await fetch(url, {
            method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(data)
        });
        return res.json();
    }

    // Remove
    document.body.addEventListener('click', async function(e){
        const btn = e.target.closest('.remove-item');
        if (!btn) return;
        const id = btn.dataset.id;
        btn.disabled = true;
        try {
            const res = await fetch(`/cart/${id}`, { method: 'DELETE', headers: {'X-CSRF-TOKEN': csrf, 'X-Requested-With': 'XMLHttpRequest'} });
            const json = await res.json();
            if (json.success) {
                const el = document.querySelector('.cart-item[data-id="'+id+'"]');
                if (el) el.remove();
                document.getElementById('cartTotal').textContent = Number(json.total || 0).toFixed(2);
            } else {
                alert(json.message || 'No se pudo eliminar.');
            }
        } catch (err) { console.error(err); alert('Error'); }
        finally { btn.disabled = false; }
    });

    // Increase / decrease
    document.body.addEventListener('click', async function(e){
        const inc = e.target.closest('.qty-increase');
        const dec = e.target.closest('.qty-decrease');
        if (!inc && !dec) return;
        const id = (inc || dec).dataset.id;
        const input = document.querySelector('.qty-input[data-id="'+id+'"]');
        if (!input) return;
        let qty = parseInt(input.value) || 1;
        qty = inc ? qty + 1 : Math.max(1, qty - 1);
        input.value = qty;
        await updateQty(id, qty);
    });

    // Manual change
    document.body.addEventListener('change', function(e){
        const input = e.target.closest('.qty-input');
        if (!input) return;
        const id = input.dataset.id;
        let qty = parseInt(input.value) || 1;
        if (qty < 1) qty = 1;
        input.value = qty;
        updateQty(id, qty);
    });

    async function updateQty(id, qty) {
        try {
            const json = await postJson(`/cart/${id}`, { quantity: qty }, 'PUT');
            if (json.success) {
                const subtotalEl = document.getElementById('subtotal-' + id);
                if (subtotalEl && json.item && json.item.subtotal !== undefined) {
                    subtotalEl.textContent = 'C$ ' + Number(json.item.subtotal).toFixed(2);
                }
                document.getElementById('cartTotal').textContent = Number(json.total).toFixed(2);
            } else {
                alert(json.message || 'No se pudo actualizar.');
            }
        } catch (err) { console.error(err); alert('Error al actualizar cantidad'); }
    }

    document.getElementById('checkoutBtn')?.addEventListener('click', function(e){
        e.preventDefault();
        alert('Implementa el flujo de checkout / órdenes según tu lógica.');
    });
});
</script>
@endsection