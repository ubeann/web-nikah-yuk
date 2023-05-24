<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>
        Nikah Yuk
        @if (View::hasSection('title')) - @endif
        @yield('title')
    </title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Include your CSS stylesheets here -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- CSS -->
    @yield('css')
</head>
<body>

    <!-- Header -->
    <header class="header">
        <!-- PHP to check if the route is landing -->
        @php
            // Check if the route is landing
            $routeName = Route::currentRouteName();
            $isLanding = $routeName == 'landing';

            // Routes
            $mainRoute = $isLanding ? '' : route('client.landing');
            $routes = [
                'Home' => $mainRoute . '#home',
                'Service' => $mainRoute . '#service',
                'About' => $mainRoute . '#about',
                'Gallery' => $mainRoute . '#gallery',
                'Price' => $mainRoute . '#price',
                'Review' => $mainRoute . '#review',
                'Contact' => $mainRoute . '#contact',
            ];
            $landingRoute = $isLanding ? '#' : route('client.landing');
        @endphp

        <!-- Logo -->
        <a href="{{ $landingRoute }}" class="logo"><span>Nikah</span>Yuk</a>

        <!-- Navbar -->
        <nav class="navbar">
            <!-- Section -->
            @foreach ($routes as $name => $link)
                <a href="{{ $link }}" >{{ $name }}</a>
            @endforeach

            <!-- Buttons -->
            <a href="{{ route('client.login.form') }}" class="login">Login</a>
            <a href="{{ route('client.register.form') }}" class="register">Register</a>

            <!-- Dropdown -->
            {{-- <div class="dropdown">
                <a href="#" class="dropdown-toggle">Account</a>
                <div class="dropdown-menu">
                    <a href="{{ route('client.login') }}" class="dropdown-item">Login</a>
                    <a href="{{ route('client.register') }}" class="dropdown-item">Register</a>
                </div>
            </div> --}}
        </nav>

        <!-- Menu -->
        <div id="menu-bars" class="fas fa-bars"></div>

    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="credit">
            &copy; {{ date('Y') }} Nikah Yuk Website | All rights reserved | Made with <i class="fas fa-heart"></i> by <a href="#">Nikah Yuk Team</a>
        </div>
    </footer>

    <!-- Include your JavaScript files here -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- JavaScript -->
    @yield('js')
</body>
</html>
