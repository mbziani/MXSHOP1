@extends('layouts.app')

@section('title', 'Manage Products')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Manage Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <img src="{{ $product->image }}" width="50" height="50" style="object-fit: cover;">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>
                                    @if($product->stock > 0)
                                        <span class="text-success">{{ $product->stock }}</span>
                                    @else
                                        <span class="text-danger">Out of Stock</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.products.delete', $product) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
