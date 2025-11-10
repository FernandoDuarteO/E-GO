<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\Cart;

class MergeSessionCartOnLogin
{
    public function handle(Login $event)
    {
        $user = $event->user;
        $sessionCart = session()->get('cart', []);
        // Ensure user has a cart record
        $cart = Cart::firstOrCreate(['user_id' => $user->id], ['session_id' => session()->getId()]);

        if (empty($sessionCart)) {
            // nothing to merge, but update session_id for reference
            $cart->session_id = session()->getId();
            $cart->save();
            return;
        }

        foreach ($sessionCart as $productId => $item) {
            $productId = (int) $productId;
            $existing = $cart->items()->where('product_id', $productId)->first();
            $qty = (int) ($item['quantity'] ?? 1);
            $price = (float) ($item['price'] ?? 0);

            if ($existing) {
                $existing->quantity += $qty;
                $existing->subtotal = $existing->quantity * $existing->price;
                $existing->save();
            } else {
                $cart->items()->create([
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'price' => $price,
                    'subtotal' => $price * $qty,
                    'options' => $item['options'] ?? null,
                ]);
            }
        }

        // clear session cart after merging
        session()->forget('cart');
    }
}