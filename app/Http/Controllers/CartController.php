<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = $this->getCart();

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity ?? 1;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $request->quantity ?? 1
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $itemId)
    {
        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['success' => true]);
    }

    public function remove($itemId)
    {
        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }

    private function getCart()
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        } else {
            $sessionId = session()->getId();
            $cart = Cart::firstOrCreate(['session_id' => $sessionId]);
        }

        return $cart->load('items.product');
    }
}   
