@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add New Product</h1>
        <a href="{{ route('admin.products') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-control @error('category_id') is-invalid @enderror"
                                id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" class="form-control @error('brand') is-invalid @enderror"
                            id="brand" name="brand" required>
                        @error('brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                            id="price" name="price" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror"
                            id="stock" name="stock" required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Image URL</label>
                        <input type="url" class="form-control @error('image') is-invalid @enderror"
                            id="image" name="image" placeholder="https://example.com/image.jpg">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="size" class="form-label">Sizes (comma separated)</label>
                        <input type="text" class="form-control" id="size" name="size"
                            placeholder="S,M,L,XL">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control" id="color" name="color">
                    </div>

                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" rows="5" required></textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
