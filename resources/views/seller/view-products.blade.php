@extends('layouts.seller')

@section('content')
<div class="bg-light mt-5 mb-5" style="padding: 20px;">
    <center>
        <h4>Products</h4>
    </center>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('destroy'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('destroy') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    <a href="{{ route('seller.add-product-form') }}" class="btn btn-primary mb-3">Add Product</a>
    <div class="table-responsive">
        <table class="table" id="product">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->product_id }}</td>
                        <td>{{ $product->p_name }}</td>
                        <td>{{ Str::limit($product->p_description, 100) }}</td>
                        <td>{{ $product->p_price }}</td>
                        <td>{{ $product->category->c_name ?? 'No Category' }}</td>
                        <td><img src="{{ asset($product->p_image_path) }}" width="100" alt="{{ $product->p_name }}"></td>
                        <td>
                            <a href="{{ route('seller.edit-product', $product->product_id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('seller.delete-product', $product->product_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
