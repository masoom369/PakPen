@extends('layouts.website')
@section('content')
<main>
    <div class="container mt-3 mb-3">
        <div id="responseMessage"></div>
    </div>
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
                        <p>Seller Name: </p>
                        <p>Product Name: {{ $product->p_name }}</p>
                        <p>Product Description: {{ $product->p_description }}</p>
                    </div>
                    <div class="mb-2">
                        <label for="p_price" class="form-label">Price</label>
                        <input type="number" name="p_price" id="p_price" value="{{ $product->p_price }}" class="form-control p-price" readonly />
                    </div>

                    <button type="submit" class="btn text-white" style="background-color:#d8ae7e;">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.addToCartForm').on('submit', function(event) {
            event.preventDefault();

            var form = $(this);
            var formData = form.serialize();

            $.ajax({
                url: form.attr('action')
                , method: 'POST'
                , data: formData
                , success: function(response) {
                    $('#responseMessage').html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ${response.message}
                            <button type="button" class="btn-close mt-2" aria-label="Close">X</button>
                        </div>
                    `);
                }
                , error: function(xhr) {
                    var errorMessage = xhr.responseJSON.message || 'An error occurred.';
                    $('#responseMessage').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${errorMessage}
                            <button type="button" class="btn-close mt-2" aria-label="Close">X</button>
                        </div>
                    `);
                }
            });
        });

        $('.p-quantity').on('change', function() {
            var quantity = $(this).val();
            var pricePerUnit = $(this).data('price');
            var priceInput = $(this).closest('form').find('.p-price');
            priceInput.val(quantity * pricePerUnit);
        });

        $(document).on('click', '.alert-dismissible .btn-close', function() {
            $(this).parent().alert('close');
        });
    });

</script>
@endsection