<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    protected function getUserCart(Request $request)
    {
        if (!auth()->check()) {
            return null;
        }
        $user = auth()->user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id], ['session_id' => session()->getId()]);
        return $cart;
    }

    // Mostrar carrito (blade o JSON)
    public function index(Request $request)
    {
        $cartModel = $this->getUserCart($request);
        if ($cartModel) {
            // load items & product
            $items = $cartModel->items()->with('product')->get()->map(function($i){
                return [
                    'id' => $i->product_id,
                    'name' => $i->product->name ?? $i->product_id,
                    'price' => (float) $i->price,
                    'quantity' => (int) $i->quantity,
                    'subtotal' => (float) $i->subtotal,
                    'image' => $i->product->productImages->first()->file_path ?? $i->product->media_file ?? null,
                    'vendor' => optional($i->product->user)->name,
                ];
            })->toArray();
            $total = $cartModel->total;
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['cart' => $items, 'total' => $total]);
            }
            return view('client_products.cart', ['cart' => $items, 'total' => $total]);
        }

        // session-based
        $sessionCart = $request->session()->get('cart', []);
        $total = collect($sessionCart)->sum(fn($i)=> $i['subtotal']);
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['cart' => array_values($sessionCart), 'total' => $total]);
        }
        return view('client_products.cart', ['cart' => $sessionCart, 'total' => $total]);
    }

    // Agregar al carrito (session o DB)
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
            'options' => 'nullable|array',
        ]);
        $qty = $data['quantity'] ?? 1;
        $product = Product::findOrFail($data['product_id']);
        $price = (float) $product->price;

        if (auth()->check()) {
            $cart = $this->getUserCart($request);
            DB::transaction(function() use ($cart, $product, $qty, $price, $data) {
                $item = $cart->items()->where('product_id', $product->id)->first();
                if ($item) {
                    $item->quantity += $qty;
                    $item->subtotal = $item->quantity * $item->price;
                    $item->save();
                } else {
                    $cart->items()->create([
                        'product_id' => $product->id,
                        'quantity' => $qty,
                        'price' => $price,
                        'subtotal' => $price * $qty,
                        'options' => $data['options'] ?? null,
                    ]);
                }
            });
            $total = $cart->fresh()->total;
            return response()->json(['success' => true, 'cart_count' => $cart->items()->count(), 'total' => $total]);
        }

        // Session-based
        $cart = $request->session()->get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $qty;
            $cart[$product->id]['subtotal'] = $cart[$product->id]['quantity'] * $cart[$product->id]['price'];
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $price,
                'quantity' => $qty,
                'image' => $product->productImages->first()->file_path ?? $product->media_file ?? null,
                'vendor' => optional($product->user)->name ?? null,
                'subtotal' => $price * $qty,
            ];
        }
        $request->session()->put('cart', $cart);
        $total = collect($cart)->sum(fn($i) => $i['subtotal']);
        return response()->json(['success' => true, 'cart_count' => count($cart), 'total' => $total]);
    }

    // Actualizar cantidad
    public function update(Request $request, $id)
    {
        $data = $request->validate(['quantity' => 'required|integer|min:1']);
        $qty = (int) $data['quantity'];

        if (auth()->check()) {
            $cart = $this->getUserCart($request);
            $item = $cart->items()->where('product_id', $id)->first();
            if (!$item) return response()->json(['success' => false, 'message' => 'Not found'], 404);
            $item->quantity = $qty;
            $item->subtotal = $item->price * $qty;
            $item->save();
            return response()->json(['success' => true, 'item' => $item, 'total' => $cart->fresh()->total]);
        }

        $cart = $request->session()->get('cart', []);
        if (!isset($cart[$id])) return response()->json(['success' => false, 'message' => 'Not found'], 404);
        $cart[$id]['quantity'] = $qty;
        $cart[$id]['subtotal'] = $cart[$id]['price'] * $qty;
        $request->session()->put('cart', $cart);
        $total = collect($cart)->sum(fn($i) => $i['subtotal']);
        return response()->json(['success' => true, 'item' => $cart[$id], 'total' => $total]);
    }

    // Eliminar producto
    public function destroy(Request $request, $id)
    {
        if (auth()->check()) {
            $cart = $this->getUserCart($request);
            $item = $cart->items()->where('product_id', $id)->first();
            if ($item) {
                $item->delete();
                return response()->json(['success' => true, 'total' => $cart->fresh()->total, 'count' => $cart->items()->count()]);
            }
            return response()->json(['success' => false, 'message' => 'Not found'], 404);
        }

        $cart = $request->session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            $request->session()->put('cart', $cart);
            $total = collect($cart)->sum(fn($i) => $i['subtotal']);
            return response()->json(['success' => true, 'total' => $total, 'count' => count($cart)]);
        }

        return response()->json(['success' => false, 'message' => 'Not found'], 404);
    }

    // Vaciar carrito
    public function clear(Request $request)
    {
        if (auth()->check()) {
            $cart = $this->getUserCart($request);
            $cart->items()->delete();
            return response()->json(['success' => true]);
        }
        $request->session()->forget('cart');
        return response()->json(['success' => true]);
    }
}