@extends('layouts.website')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('website/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

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

    <!-- Shopping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('order.place') }}" method="POST">
                        @csrf
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Items</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cartItems as $item)
                                        <tr>
                                            <td class="shoping__cart__item">
                                                @if ($item->product)
                                                    <img src="{{ asset($item->product->p_image_path) }}" style="width: 100px; height: 100px;" alt="{{ $item->product->p_name }}">
                                                    <h5>{{ $item->product->p_name }}</h5>
                                                @endif
                                                @if ($item->book)
                                                    <img src="{{ asset($item->book->b_image_path) }}" style="width: 100px; height: 100px;" alt="{{ $item->book->b_name }}">
                                                    <h5>{{ $item->book->b_name }}</h5>
                                                @endif
                                            </td>
                                            <td class="shoping__cart__price">
                                                ${{ number_format($item->product->p_price ?? $item->book->b_price, 2) }}
                                            </td>
                                            <td>
                                                <div class="pro-qty">
                                                    <select name="quantities[{{ $item->cart_item_id }}]" class="form-select quantity-dropdown" data-item-id="{{ $item->cart_item_id }}" data-price="{{ $item->product->p_price ?? $item->book->b_price }}">
                                                        @for ($i = 1; $i <= 10; $i++)
                                                            <option value="{{ $i }}" {{ $i == $item->order_quantity ? 'selected' : '' }}>
                                                                {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total" id="total-price-{{ $item->cart_item_id }}">
                                                ${{ number_format(($item->product->p_price ?? $item->book->b_price) * ($item->order_quantity ?? 1), 2) }}
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <a href="{{ route('cart.remove', $item->cart_item_id) }}" class="primary-btn cart-btn cart-btn-right">del</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Your cart is empty.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-lg-6">
                            <div class="shoping__checkout">
                                <h5>Cart Total</h5>
                                <ul>
                                    <li>Total <span id="cart-total">${{ number_format($cartSummary['totalPrice'], 2) }}</span></li>
                                </ul>
                                <button type="submit" class="primary-btn">PROCEED TO CHECKOUT</button>
                            </div>
                        </div>
                    </form>

        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdowns = document.querySelectorAll('.quantity-dropdown');

            // Function to update and store cart total
            function updateCartTotal() {
                let cartTotal = 0;
                dropdowns.forEach(function(itemDropdown) {
                    const itemQuantity = parseInt(itemDropdown.value);
                    const itemPrice = parseFloat(itemDropdown.getAttribute('data-price'));
                    cartTotal += itemQuantity * itemPrice;
                });

                // Update cart total display
                document.getElementById('cart-total').innerText = '$' + cartTotal.toFixed(2);

                // Store cartTotal in localStorage
                localStorage.setItem('cartTotal', cartTotal.toFixed(2));
            }

            // Attach event listeners to dropdowns
            dropdowns.forEach(function(dropdown) {
                dropdown.addEventListener('change', function() {
                    const itemId = this.getAttribute('data-item-id');
                    const quantity = parseInt(this.value);
                    const price = parseFloat(this.getAttribute('data-price'));

                    // Update individual item total
                    const totalPrice = (quantity * price).toFixed(2);
                    document.getElementById('total-price-' + itemId).innerText = '$' + totalPrice;

                    // Recalculate and store cart total
                    updateCartTotal();
                });
            });

            // Initialize cart total on load
            updateCartTotal();
        });
    </script>



@endsection
