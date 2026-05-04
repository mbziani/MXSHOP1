@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Checkout</h1>

    <div class="row">
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Shipping Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.store') }}" method="POST" id="checkout-form">
                        @csrf
                        <div class="mb-3">
                            <label for="shipping_address" class="form-label">Shipping Address</label>
                            <textarea name="shipping_address" id="shipping_address" rows="3"
                                      class="form-control @error('shipping_address') is-invalid @enderror" required></textarea>
                            @error('shipping_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" name="phone" id="phone"
                                   class="form-control @error('phone') is-invalid @enderror" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method"
                                       id="cash" value="cash" checked>
                                <label class="form-check-label" for="cash">
                                    Cash on Delivery
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method"
                                       id="card" value="card">
                                <label class="form-check-label" for="card">
                                    Credit/Debit Card (Demo)
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    @foreach($cart->items as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                            <span>${{ number_format($item->product->price * $item->quantity, 2) }}</span>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <strong>Total:</strong>
                        <strong>${{ number_format($cart->items->sum(function($item) {
                            return $item->product->price * $item->quantity;
                        }), 2) }}</strong>
                    </div>

                    <button type="submit" form="checkout-form" class="btn btn-primary w-100 mt-3">
                        Place Order
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
