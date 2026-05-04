<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Motocross Shop - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-red: #E31837;
            --dark-gray: #1a1a1a;
            --light-gray: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--light-gray);
        }

        .navbar {
            background: var(--dark-gray) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary-red) !important;
        }

        .nav-link {
            color: white !important;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--primary-red) !important;
        }

        .btn-primary {
            background: var(--primary-red);
            border: none;
        }

        .btn-primary:hover {
            background: #c4122e;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }

        .product-image {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }

        .footer {
            background: var(--dark-gray);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--primary-red);
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-motorcycle"></i> MX Gear
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}">My Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.index') }}">{{ Auth::user()->name }}</a>
                        </li>
                        @if(Auth::user()->is_admin)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-crown"></i> Admin
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                    <li class="nav-item position-relative">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            <span class="cart-badge" id="cart-count">0</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-motorcycle"></i> MX Gear</h5>
                    <p>Your ultimate destination for premium motocross gear and accessories.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('products.index') }}" class="text-white-50">Products</a></li>
                        <li><a href="#" class="text-white-50">About Us</a></li>
                        <li><a href="#" class="text-white-50">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <a href="#" class="text-white-50 me-3"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" class="text-white-50 me-3"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#" class="text-white-50"><i class="fab fa-twitter fa-2x"></i></a>
                </div>
            </div>
            <hr class="bg-white">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 MX Gear. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Update cart count
        function updateCartCount() {
            $.get('/cart', function(data) {
                let count = 0;
                if (data.cart && data.cart.items) {
                    count = data.cart.items.length;
                }
                $('#cart-count').text(count);
            });
        }

        $(document).ready(function() {
            updateCartCount();
        });
    </script>
    @stack('scripts')
</body>
</html>
