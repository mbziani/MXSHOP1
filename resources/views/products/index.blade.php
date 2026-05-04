@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Categories</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('products.index') }}"
                           class="list-group-item list-group-item-action {{ !request('category') ? 'active' : '' }}">
                            All Products
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                               class="list-group-item list-group-item-action {{ request('category') == $category->slug ? 'active' : '' }}">
                                <i class="fas fa-chevron-right me-2"></i>{{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Search</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('products.index') }}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-md-9">
            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="product-card">
                            <img src="{{ $product->image }}" class="product-image" alt="{{ $product->name }}">
                            <div class="p-3">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="text-muted">{{ $product->brand }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="text-primary mb-0">${{ number_format($product->price, 2) }}</h4>
                                    <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary btn-sm">
                                        View Details
                                    </a>
                                </div>
                                @if($product->stock > 0)
                                    <small class="text-success">In Stock</small>
                                @else
                                    <small class="text-danger">Out of Stock</small>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            No products found.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
