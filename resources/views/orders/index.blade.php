@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">My Orders</h1>

    @if($orders->count() > 0)
        <div class="row">
            @foreach($orders as $order)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong>Order #{{ $order->order_number }}</strong>
                            <span class="badge
                                @if($order->status == 'pending') bg-warning
                                @elseif($order->status == 'processing') bg-info
                                @elseif($order->status == 'shipped') bg-primary
                                @elseif($order->status == 'delivered') bg-success
                                @else bg-danger
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="card-body">
                            <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                            <p><strong>Total:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                            <p><strong>Items:</strong> {{ $order->items->count() }}</p>
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-primary btn-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            <i class="fas fa-box-open fa-3x mb-3"></i>
            <h4>No orders yet</h4>
            <p>Start shopping to see your orders here!</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Shop Now</a>
        </div>
    @endif
</div>
@endsection
