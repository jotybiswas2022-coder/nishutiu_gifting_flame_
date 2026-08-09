<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Setting;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $items = Item::with('images', 'category')->whereIn('id', array_keys($cart))->get()->keyBy('id');

        $lines = [];
        $total = 0;
        foreach ($cart as $itemId => $qty) {
            if (!isset($items[$itemId])) {
                continue;
            }
            $item = $items[$itemId];
            $lineTotal = $item->price * $qty;
            $total += $lineTotal;
            $lines[] = [
                'item' => $item,
                'qty' => $qty,
                'lineTotal' => $lineTotal,
            ];
        }

        $deliveryCharge = (float) Setting::get('delivery_charge', 0);
        $grandTotal = $total + $deliveryCharge;

        return view('frontend.cart', compact('lines', 'total', 'deliveryCharge', 'grandTotal'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|integer|exists:items,id',
            'qty' => 'required|integer|min:1|max:99',
        ]);

        $cart = session('cart', []);
        $id = (int) $validated['item_id'];
        $qty = (int) $validated['qty'];

        $cart[$id] = ($cart[$id] ?? 0) + $qty;
        session(['cart' => $cart]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Item added to cart.',
                'cartCount' => array_sum($cart),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Item added to your cart.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer|exists:items,id',
            'qty' => 'required|integer|max:99',
        ]);

        $cart = session('cart', []);
        $id = (int) $request->input('item_id');
        $qty = (int) $request->input('qty');

        if (isset($cart[$id])) {
            if ($qty < 1) {
                unset($cart[$id]);
            } else {
                $cart[$id] = $qty;
            }
        }

        session(['cart' => $cart]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'cartCount' => array_sum($cart)]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
        ]);

        $cart = session('cart', []);
        unset($cart[(int) $request->input('item_id')]);
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Cart cleared.');
    }
}