<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pakpen</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('website/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/css/style.css') }}" type="text/css">

    <style>
        /* Ensure the body and html take up the full height of the viewport */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        /* Hide loader container */
        .hidden {
            display: none;
        }

        #preloader {
            position: fixed;
            left: 0;
            top: 0;
            z-index: 999999;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loader {
            width: 40px;
            height: 40px;
            border: 4px solid #d8ae7e;
            border-left-color: #ffffff;
            background-color: #ccc;
            border-radius: 50%;
            animation: loader 1.5s linear infinite;
        }

        @keyframes loader {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #preloader.fade-out {
            opacity: 0;
            visibility: hidden;
        }

        html.over_hid {
            overflow: hidden;
        }

        /* Header styles */
        header {
            margin-top: 3px;
            margin-bottom: 3px;
        }

        .header__menu ul {
            display: flex;
            padding: 0;
            margin: 0;
            list-style: none;
            flex-grow: 1;
            justify-content: center;
        }

        .header__menu ul li {
            margin-right: 20px;
            position: relative;
            padding: 0 10px;
        }

        .header__menu ul li a {
            font-size: 14px;
            color: #252525;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 1px 0;
            display: block;
        }
        .header__menu ul li button {
            font-size: 14px;
            color: #252525;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 1px 0;
            display: block;
            margin: -3px;
        }

        .header__cart {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header__cart .header__cart__price {
            font-size: 14px;
            color: #6f6f6f;
            display: inline-block;
            margin-left: 10px;
        }

        .header__logo {
            padding: 20px 0;
            margin-left: 40px;
        }

        .header .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0;
            margin: 0;
            max-width: 100%;
            box-sizing: border-box;
        }

        .header-wrapper {
            padding: 0 15px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        header .container {
            padding: 0;
            margin: 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header__logo {
                padding: 5px 0;
                margin-left: 0;
            }

            header {
                margin-top: 3px;
                margin-bottom: 5px;
            }

            .header__menu ul li {
                margin-right: 15px;
            }

            .header__menu ul {
                text-align: center;
            }

            .header__cart {
                text-align: center;
                padding: 0;
                margin-top: 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .header__cart .header__cart__price {
                font-size: 14px;
                text-align: center;
            }

            .header__menu {
                display: none;
            }

            #searchbar {
                padding: 10px;
                font-size: 14px;
            }
        }

        /* Search bar styles */
        #searchbar {
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            margin: 0 auto;
            display: block;
            max-width: 900px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Adjustments for very small screens */
        @media (max-width: 480px) {
            #searchbar {
                padding: 10px;
                font-size: 12px;
            }
        }

        #list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .search-item {
            font-size: 1.2em;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            display: none;
            animation: fadeIn 0.5s ease-in-out;
        }

        .search-item:last-child {
            border-bottom: none;
        }

        .logout-button {
            background: none;
            border: none;
            font: inherit !important;
            white-space: nowrap;
        }

        .logout-button:hover {
            color: #d8ae7e;
        }

        .custom-row {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .custom-col {
            flex: 1;
        }

        .quantity-dropdown {
            max-height: 30px !important;
            overflow-y: auto;
            border: none;
        }

        .alert-dismissible .btn-close {
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.75rem 1.25rem;
            color: inherit;
        }

        .hero__text {
            background-color: rgb(255, 227, 187, 0.5);
        }
    </style>

</head>

<body>

    <!-- Humberger Menu Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="{{ url('/') }}"><img src="{{ asset('logo.png') }}" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li>
                    <a href="{{ url('cart') }}">
                        <i class="fa fa-shopping-bag"></i>
                        <span id="cart-items-count">{{ $cartSummary['totalItems'] ?? 0 }}</span>
                        <!-- Server-side value with fallback to 0 -->
                    </a>
                </li>
            </ul>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/cart') }}">Cart</a></li>
                <li><a href="{{ url('/aboutus') }}">About Us</a></li>
                <li><a href="{{ url('/contactus') }}">Contact Us</a></li>
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ url('/home') }}">Dashboard</a></li>
                        <li><a href="{{ route('profile.show') }}">Profile</a></li>
                        <li><a >
                            <form method="POST" action="{{ url('logout') }}">
                                @csrf
                                <button type="submit" class="logout-button">{{ __('Log Out') }}</button>
                            </form></a>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Log in</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endauth
                @endif
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
    </div>
    <!-- Humberger Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top"></div>
        <div class="container header-wrapper">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('logo.png') }}"
                                style="width: 150px; height:60px;" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/library') }}">Library</a></li>
                            <li><a href="{{ url('/cart') }}">Cart</a></li>
                            <li><a href="{{ url('/aboutus') }}">About</a></li>
                            <li><a href="{{ url('/contactus') }}">Contact</a></li>
                            @if (Route::has('login'))
                                @auth
                                    <li><a href="{{ url('/home') }}">Dashboard</a></li>
                                    <li><a>
                                        <form method="POST" action="{{ url('logout') }}">
                                            @csrf
                                            <button type="submit" class=" text-black bg-white" style="border:none;margin-bottom:-15px;;">{{ __('Log Out') }}</button>
                                        </form></a>
                                    </li>
                                @else
                                    <li><a href="{{ route('register') }}">Register</a></li>
                                    <li><a href="{{ route('login') }}">Log in</a></li>
                                @endauth
                            @endif
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li>
                                <a href="{{ url('cart') }}">
                                    <i class="fa fa-shopping-bag"></i>
                                    <span id="cart-items-count">{{ $cartSummary['totalItems'] ?? 0 }}</span>
                                    <!-- Server-side value with fallback to 0 -->
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All Categories</span>
                        </div>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a href="{{ url('categorywise', $category->category_id) }}"
                                        class="mb-1">{{ $category->c_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 search">
                    <!-- Search bar inside a flex container for better responsiveness -->
                    <div style="display: flex; justify-content: center; margin-bottom: 20px;">
                        <input id="searchbar" onkeyup="search_item()" type="text" name="search"
                            placeholder="Search items...">
                    </div>

                    <ul id="list">
                        @foreach ($products as $product)
                            <li class="search-item"><a
                                    href="{{ url('product-detail', $product->product_id) }}">product/{{ $product->p_name }}</a>
                            </li>
                        @endforeach
                        @foreach ($books as $book)
                            <li class="search-item"><a
                                    href="{{ url('book-detail', $book->book_id) }}">book/{{ $book->b_name }}</a>
                            </li>
                        @endforeach
                        @foreach ($categories as $category)
                            <li class="search-item"><a
                                    href="{{ url('categorywise', $category->category_id) }}">Category/{{ $category->c_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->


    @yield('content')

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="{{ url('/') }}"><img src="{{ asset('logo-no-bg.png') }}"
                                    style="width: 130px; height:60px" alt=""></a>
                        </div>
                        <p>
                            At Pakpen, we provide high-quality stationery for every need, from essentials to premium
                            items. Enjoy a seamless shopping experience with us for office supplies and art supplies.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            @if (Route::has('login'))
                                @auth
                                    <li><a href="{{ url('/home') }}">Dashboard</a></li>
                                    <li><a href="{{ route('profile.show') }}">Profile</a></li>
                                @else
                                    <li><a href="{{ route('login') }}">Log in</a></li>
                                    <li><a href="{{ route('register') }}">Register</a></li>
                                @endauth
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 footercontact">
                    <div class="custom-row">
                        <div class="custom-col footer__widget">
                            <h6>Contact Info</h6>
                            <ul>
                                @if ($admin)
                                    <li>Address: {{ $admin->address }}</li>
                                    <li>Phone: {{ $admin->phone }}</li>
                                    <li>Email: {{ $admin->email }}</li>
                                @else
                                    <li>No admin found.</li>
                                @endif
                            </ul>
                        </div>
                        <div class="custom-col">
                            <a href="{{ url('/contactus') }}" class="site-btn">Contact Us</a>
                        </div>
                        <div class="custom-col">
                            <div class="footer__widget__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <center>
                            <p>
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved
                                &nbsp;
                                <img src="{{ asset('website/img/payment-item.png') }}" alt="">
                            </p>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('website/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('website/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('website/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('website/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('website/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('website/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('website/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.scrollTo(0, 0); // Scrolls to the top of the page
        });

        function search_item() {
            let input = document.getElementById('searchbar').value.toLowerCase();
            let items = document.getElementsByClassName('search-item');

            // Iterate over all items and display based on search input
            for (let i = 0; i < items.length; i++) {
                if (items[i].innerHTML.toLowerCase().includes(input) && input.length > 0) {
                    items[i].style.display = "list-item"; // Show item
                } else {
                    items[i].style.display = "none"; // Hide item
                }
            }
        }
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('{{ url('/') }}')  // Fetching from the new route
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Update the cart count and price, even if it's zero
                document.getElementById('cart-items-count').textContent = data.totalItems || 0;
            })
            .catch(error => console.error('Error fetching cart summary:', error));
    });
</script>

</body>

</html>
