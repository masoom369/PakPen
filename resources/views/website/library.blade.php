@extends('layouts.website')
@section('content')
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
            @foreach ($books as $book)
            <a href="{{ url('book-detail', $book->book_id) }}">
                <div class="col-lg-3 col-md-4 col-sm-6 mix category-{{ $book->category_id }}">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset($book->b_image_path) }}">
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">{{ $book->b_name }}</a></h6>
                            <h5>{{ $book->b_price }}</h5>
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
