@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $product->image }}" class="img-fluid rounded shadow" alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                </ol>
            </nav>

            <h1>{{ $product->name }}</h1>
            <h3 class="text-primary">${{ number_format($product->price, 2) }}</h3>

            <div class="mb-3">
                <span class="badge bg-secondary">{{ $product->brand }}</span>
                <span class="badge bg-info">{{ $product->category->name }}</span>
            </div>

            <div class="mb-3">
                @if($product->stock > 0)
                    <span class="text-success"><i class="fas fa-check-circle"></i> In Stock ({{ $product->stock }} available)</span>
                @else
                    <span class="text-danger"><i class="fas fa-times-circle"></i> Out of Stock</span>
                @endif
            </div>

            @if($product->size)
                <div class="mb-3">
                    <strong>Sizes:</strong> {{ $product->size }}
                </div>
            @endif

            @if($product->color)
                <div class="mb-3">
                    <strong>Colors:</strong> {{ $product->color }}
                </div>
            @endif

            <div class="mb-4">
                <h5>Description</h5>
                <p>{{ $product->description }}</p>
            </div>

            @if($product->stock > 0)
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex gap-3">
                    @csrf
                    <div class="form-group" style="width: 120px;">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
                    </div>
                    <div class="form-group d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                    </div>
                </form>
            @else
                <button class="btn btn-secondary btn-lg" disabled>Out of Stock</button>
            @endif
        </div>
    </div>
</div>
@endsection
