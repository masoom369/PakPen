@extends('layouts.website')

@section('content')
<div class="container">
    <div class="col-lg-12">
        <div class="hero__item set-bg" data-setbg="{{ asset('website/img/hero/home.png') }}">
            <div class="hero__text">
                <h5>PREMIUM STATIONERY</h5>
                <h2>Your One-Stop <br />Stationery Shop</h2>
                <h5>High-Quality Products For All Your Needs</h5>
                <br>
                <a href="#featured" class="primary-btn">SHOP NOW</a>
            </div>
        </div>
    </div>
</div>
<br>

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach ($categories as $category)
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{ asset($category->c_image_path) }}">
                        <h5><a href="{{ url('categorywise', $category->category_id) }}">{{ $category->c_name }}</a></h5>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad" id="featured">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Product</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <!-- Static filter item for 'All' -->
                        <li class="active" data-filter="*">All</li>

                        <!-- Loop through categories to create dynamic filter items -->
                        @foreach ($categories as $category)
                        <li data-filter=".category-{{ $category->category_id }}">{{ $category->c_name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            <!-- Loop through products to display them -->
            @foreach ($products as $product)
            <a href="{{ url('product-detail', $product->product_id) }}">
                <div class="col-lg-3 col-md-4 col-sm-6 mix category-{{ $product->category_id }}">
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
</section>

<!-- Include MixItUp library for filtering functionality -->
<script src="https://cdn.jsdelivr.net/npm/mixitup@3/dist/mixitup.min.js"></script>
<script>
    var mixer = mixitup('.featured__filter', {
        selectors: {
            target: '.mix'
        }
        , animation: {
            duration: 300
        }
    });

</script>

@endsection
