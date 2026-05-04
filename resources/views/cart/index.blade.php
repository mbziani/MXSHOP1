@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Shopping Cart</h1>

    @if($cart && $cart->items->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>${{ number_format($item->product->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Calculate and display total --}}
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Order Summary</h4>
                        <table class="table">
                            <tr>
                                <td>Subtotal:</td>
                                <td>${{ number_format($cart->items->sum(function($item) {
                                    return $item->product->price * $item->quantity;
                                }), 2) }}</td>
                            </tr>
                            <tr>
                                <td>Shipping:</td>
                                <td>$0.00</td>
                            </tr>
                            <tr>
                                <td><strong>Total:</strong></td>
                                <td><strong>${{ number_format($cart->items->sum(function($item) {
                                    return $item->product->price * $item->quantity;
                                }), 2) }}</strong></td>
                            </tr>
                        </table>

                        {{-- BUY / CHECKOUT BUTTON --}}
                        <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-lg btn-block">
                            Proceed to Checkout
                        </a>

                        {{-- Or direct buy button --}}
                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg btn-block mt-2">
                                Buy Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="alert alert-info">
            Your cart is empty. <a href="{{ route('products.index') }}">Continue Shopping</a>
        </div>
    @endif
</div>
@endsection
