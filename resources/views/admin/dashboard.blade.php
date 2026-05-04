@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Products</h5>
                            <h2 class="mb-0">{{ $totalProducts }}</h2>
                        </div>
                        <i class="fas fa-tshirt fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Orders</h5>
                            <h2 class="mb-0">{{ $totalOrders }}</h2>
                        </div>
                        <i class="fas fa-shopping-cart fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Customers</h5>
                            <h2 class="mb-0">{{ $totalUsers }}</h2>
                        </div>
                        <i class="fas fa-users fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Recent Orders</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>${{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            <span class="badge
                                                @if($order->status == 'pending') bg-warning
                                                @elseif($order->status == 'processing') bg-info
                                                @elseif($order->status == 'shipped') bg-primary
                                                @elseif($order->status == 'delivered') bg-success
                                                @else bg-danger
                                                @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary me-2">
                        <i class="fas fa-plus"></i> Add Product
                    </a>
                    <a href="{{ route('admin.products') }}" class="btn btn-info">
                        <i class="fas fa-edit"></i> Manage Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
