@extends('layouts.website')

@section('content')
<div class="container mt-5">
    <!-- Categories Section -->
    <div class="row">
        <div class="col-lg-12">
            <h4 class="mb-4">Categories /
                <a href="{{ url('categorywise', $category->category_id) }}" style="color: black; text-decoration: none;">{{ $category->c_name }}</a>
            </h4>
        </div>
    </div>


    <!-- Products Section -->
    <div class="row">
        @foreach($products as $product)
        <a href="{{ url('product-detail', $product->product_id) }}">
            <div class="col-lg-3 col-md-4 col-sm-6 mix">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{ asset($product->p_image_path) }}">
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">{{ $product->p_name }}</a></h6>
                        <h5>{{ $product->p_price }}</h5>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>

</div>
@endsection
