@extends('layouts.admin')
@section('content')
<div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:mt-0 md:col-span-2">
        <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
            <div class="grid grid-cols-6 gap-6">
                <h1>Edit Product</h1>
                <form action="{{ route('admin.update-product', $product->product_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <label for="p_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="p_name" name="p_name" value="{{ $product->p_name }}" required>
                    </div>
                    <div class="mb-2">
                        <label for="p_description" class="form-label">Description</label>
                        <textarea class="form-control" id="p_description" name="p_description" rows="3" required>{{ $product->p_description }}</textarea>
                    </div>
                    <div class="mb-2">
                        <label for="p_price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="p_price" name="p_price" value="{{ $product->p_price }}" required>
                    </div>
                    <div class="mb-2">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="" disabled>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}" {{ $product->category_id == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->c_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="p_image_path" class="form-label">Image</label>
                        <img src="{{ asset($product->p_image_path) }}" width="100" alt="{{ $product->p_name }}" class="d-block mb-2">
                        <input type="file" class="form-control" id="p_image_path" name="p_image">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
