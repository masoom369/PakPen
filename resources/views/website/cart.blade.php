@extends('layouts.website')

@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset ('website/img/breadcrumb.jpg') }}">
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

<!-- Shopping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            @method('PUT') <!-- Ensure the method is PUT for updating the cart -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cartItems as $item)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{ asset($item->products->p_image_path) }}" style="width: 100px; height: 100px;" alt="{{ $item->products->p_name }}">
                                        <h5>{{ $item->products->p_name }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        ${{ number_format($item->p_price, 2) }}
                                    </td>
                                    <td>
                                        <div class="pro-qty">
                                            <select name="quantities[{{ $item->cart_item_id }}]" id="quantity-select-{{ $item->cart_item_id }}" style="max-width: 150px;" class="form-select quantity-dropdown" data-price="{{ $item->products->p_price }}" required>
                                                @for ($i = 1; $i <= $item->products->p_quantity; $i++)
                                                    <option value="{{ $i }}" {{ $i == $item->p_quantity ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>

                                        </div>
                                    </td>

                                    <td class="shoping__cart__total">
                                        ${{ number_format($item->p_price * $item->p_quantity, 2) }}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="{{  route('cart.remove', $item->cart_item_id) }}" class="primary-btn cart-btn cart-btn-right">del</a>

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
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <form action="{{ route('cart.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="primary-btn cart-btn cart-btn-right">
                                <span class="icon_loading"></span> Update Cart
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Total <span>${{ number_format($cartTotal, 2) }}</span></li>
                        </ul>
                        <a href="{{ route('order.place') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Shopping Cart Section End -->

@endsection
