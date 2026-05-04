<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = $this->getCart();

        if ($cart->items->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        return view('orders.checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|string'
        ]);

        $cart = $this->getCart();

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'total_amount' => $cart->items->sum(function($item) {
                return $item->product->price * $item->quantity;
            }),
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'shipping_address' => $request->shipping_address,
            'phone' => $request->phone
        ]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);

            // Reduce stock
            $product = $item->product;
            $product->stock -= $item->quantity;
            $product->save();
        }

        // Clear cart
        $cart->items()->delete();

        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully!');
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id != Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    private function getCart()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            $cart = Cart::create(['user_id' => Auth::id()]);
        }

        return $cart->load('items.product');
    }
}
