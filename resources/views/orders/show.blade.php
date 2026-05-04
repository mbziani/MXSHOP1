@extends('layouts.app')

@section('title', 'Order #' . $order->order_number)

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Orders
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Order Items</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
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
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>${{ number_format($item->price, 2) }}</td>
                                        <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Order Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Order Number:</strong><br>{{ $order->order_number }}</p>
                    <p><strong>Status:</strong><br>
                        <span class="badge
                            @if($order->status == 'pending') bg-warning
                            @elseif($order->status == 'processing') bg-info
                            @elseif($order->status == 'shipped') bg-primary
                            @elseif($order->status == 'delivered') bg-success
                            @else bg-danger
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                    <p><strong>Payment Method:</strong><br>{{ ucfirst($order->payment_method) }}</p>
                    <p><strong>Order Date:</strong><br>{{ $order->created_at->format('F d, Y H:i') }}</p>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Shipping Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Phone:</strong><br>{{ $order->phone }}</p>
                    <p><strong>Address:</strong><br>{{ $order->shipping_address }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
