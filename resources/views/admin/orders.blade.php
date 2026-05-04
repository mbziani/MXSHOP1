@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Manage Orders</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->user->name }}<br>
                                    <small>{{ $order->user->email }}</small>
                                </td>
                                <td>${{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    <select class="form-select form-select-sm order-status"
                                            data-order-id="{{ $order->id }}">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </td>
                                <td>{{ ucfirst($order->payment_method) }}</td>
                                <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info view-order"
                                            data-order-id="{{ $order->id }}">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Order Details Modal -->
<div class="modal fade" id="orderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="order-details">
                <!-- Content loaded via AJAX -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.order-status').on('change', function() {
        const orderId = $(this).data('order-id');
        const status = $(this).val();

        $.ajax({
            url: '/admin/orders/' + orderId + '/status',
            method: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(response) {
                if (response.success) {
                    alert('Order status updated successfully!');
                }
            }
        });
    });

    $('.view-order').on('click', function() {
        const orderId = $(this).data('order-id');

        // You can implement an AJAX call to get order details
        // For now, redirect to order show page
        window.location.href = '/orders/' + orderId;
    });
});
</script>
@endpush
