<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pakpen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('dashboard/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

    <!-- Template Stylesheet -->
    <link href="{{ asset('dashboard/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper d-flex">
        <!-- Sidebar Start -->
        <div class="sidebar  pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="{{ url('/') }}" class="navbar-brand mx-4 mb-3 d-flex ms-3">
                    <img src="{{ asset('logo-no-bg.png') }}" style="width: 150px; height: 50px;" alt="">
                </a>
                <div class="d-flex align-items-center ms-4">
                    <div class="position-relative">
                        <h6><img class="rounded-circle" src="{{ Auth::user()->profile_photo_url }}" alt=""
                                style="width: 40px; height: 40px;"></h6>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                        <span>Customer</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{ url('home') }}" class="nav-item nav-link">
                        <i class="fas fa-home me-2"></i>Dashboard
                    </a>
                    <a href="{{ url('cart') }}" class="nav-item nav-link">
                        <i class="fas fa-hospital me-2"></i>cart items
                    </a>
                    <a href="{{ route('user.orders') }}" class="nav-item nav-link">Orders Status</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light d-flex sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <a href="{{ url('/') }}" class="navbar-brand  d-lg-none ms-4">
                    <h1 class="mt-1" style="color:#d8ae7e;">
                        </class> <img src="{{ asset('logo-no-bg.png') }}" style="width: 150px; height: 50px;"
                            alt=""></h1>
                </a>


                <div class="navbar-nav ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle" src="{{ Auth::user()->profile_photo_url }}" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="{{ route('profile.show') }}" class="dropdown-item">Profile</a>
                            <div class="dropdown-item">
                                <form id="logout-form" method="POST" action="{{ url('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-link">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Blank Start -->
            <div class="container-fluid flex-grow-1 d-flex align-items-center justify-content-center">
                <div class="row rounded mx-0 w-100 g-4">
                    <div class="col-md-12">
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- Blank End -->

            <!-- Footer Start -->
            <div class="footer container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            Copyright &copy; 2024 <a href="{{ url('/') }}" style="color: #d8ae7e">Pakpen</a>,
                            All Right Reserved.
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <!-- Chart.js -->
    <script src="{{ asset('dashboard/lib/chart/chart.min.js') }}"></script>

    <!-- Easing library -->
    <script src="{{ asset('dashboard/lib/easing/easing.min.js') }}"></script>

    <!-- Waypoints -->
    <script src="{{ asset('dashboard/lib/waypoints/waypoints.min.js') }}"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('dashboard/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Tempus Dominus Datepicker -->
    <script src="{{ asset('dashboard/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('dashboard/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('dashboard/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('dashboard/js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#mytable').DataTable();
            $('#mytable1').DataTable();
        });
    </script>
</body>

</html>
