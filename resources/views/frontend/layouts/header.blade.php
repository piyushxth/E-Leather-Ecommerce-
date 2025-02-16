<header>
    <div class="main-header ">
        <nav class="navbar navbar-expand-lg navbar-light bg-light ">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <figure><img height='20'  src="{{ asset('frontend/images/logo.png') }}" alt="{{ env('APP_NAME') }}"></figure>
                </a>
                <!-- search bar for responsive design  -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                                href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('about-us') ? 'active' : '' }}"
                                href="{{ route('frontend.aboutus') }}">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}"
                                href="{{ route('contact') }}">
                                Contact us
                            </a>
                        </li>
                    </ul>
                    @include('frontend.layouts.auth')
                    <div class="profile-wishlist-cart">
                        <div class="profile loggedin_menu" style="display: none;">
                            <a href="{{ route('customer.dashboard') }}"> <i class="fas fa-user"></i></a>
                        </div>
                        <div class="wishlist loggedin_menu" style="display: none;">
                            <a class="position-relative" href="{{ route('customer.wishlist.index') }}">
                                <i class="fas fa-heart"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge "
                                    id="wishlist-count">
                                    {{ $wishlist_count }}
                                </span>
                            </a>
                        </div>
                        <div class="cart loggedin_menu" style="display: none;">
                            <a class="position-relative" href="{{ route('customer.cart.index') }}">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge"
                                    id="cart-count">
                                    {{ $cart_count }}
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
