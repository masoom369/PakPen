@extends('layouts.website')
@section('content')
    <main>
        <div class="container mt-3 mb-3">
            <div id="responseMessage"></div>
        </div>
        <div class="container mb-4">
            <div class="row">
                <div class="col-md-5">
                    <!-- book Image -->
                    <img src="{{ asset($book->b_image_path) }}" alt="book Image" class="img-fluid" />
                </div>
                <div class="col-md-7">
                    <form class="addToCartForm" action="{{ url('/cart/add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{ auth()->id() }}" readonly>
                        <input type="hidden" name="seller_id" id="seller_id" value="{{ $book->seller_id }}"
                            class="form-control" readonly />
                        <input type="hidden" name="book_id" id="book_id" value="{{ $book->book_id }}"
                            class="form-control" readonly />
                        <div class="mb-1">
                            <p>Seller Name: </p>
                            <p>book Name: {{ $book->b_name }}</p>
                            <p>book Description: {{ $book->b_description }}</p>
                        </div>
                        <div class="mb-2">
                            <label for="p_price" class="form-label">Price</label>
                            <input type="number" name="b_price" id="p_price" value="{{ $book->b_price }}"
                                class="form-control p-price" readonly />
                        </div>
                        <a href="{{ route('download-book', $book->book_id) }}" class="btn text-white"
                            style="background-color:#d8ae7e;">Download eBook</a>
                        <button type="submit" class="btn text-white" style="background-color:#d8ae7e;">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
