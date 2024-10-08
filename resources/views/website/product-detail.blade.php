@extends('layouts.website')
@section('content')
<main>
    <div class="container mb-4">
        <div class="row">
            <div class="col-md-5">
                <!-- Product Image -->
                <img src="{{ asset($product->p_image_path) }}" alt="Product Image" class="img-fluid" />
            </div>
            <div class="col-md-7">
                <form class="addToCartForm" action="{{ url('/cart/add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="customer_id" value="{{ auth()->id() }}" readonly>
                    <input type="hidden" name="seller_id" id="seller_id" value="{{ $product->seller_id }}" class="form-control" readonly />
                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->product_id }}" class="form-control" readonly />
                    <div class="mb-1">
                        <p>Product Name: {{ $product->p_name }}</p>
                        <p>Product Description: {{ $product->p_description }}</p>
                    </div>
                    <div class="mb-2">
                        <label for="p_price" class="form-label">Price</label>
                        <input type="number" hidden name="p_price" id="p_price" value="{{ $product->p_price }}" class="form-control p-price" readonly />
                        <label for="">PKR{{ $product->p_price }}</label>
                    </div>
                    <button type="submit" class="btn text-white" style="background-color:#d8ae7e;">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
