@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>

    @if(isset($cart) && $cart && $cart->items->count() > 0)
        <div class="row">
            <div class="col-md-8">
                <h3>Order Summary</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart->items as $item)
                        <tr>
                            <td>{{ $item->product->name }} </td>
                            <td>{{ $item->quantity }} </td>
                            <td>${{ number_format($item->product->price, 2) }} </td>
                            <td>${{ number_format($item->product->price * $item->quantity, 2) }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Total Amount</h4>
                        <h3>${{ number_format($cart->items->sum(function($item) {
                            return $item->product->price * $item->quantity;
                        }), 2) }}</h3>

                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-block">
                                Place Order
                            </button>
                        </form>

                        <a href="{{ route('cart.index') }}" class="btn btn-secondary btn-block mt-2">
                            Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            Your cart is empty. <a href="{{ route('products.index') }}">Continue Shopping</a>
        </div>
    @endif
</div>
@endsection
