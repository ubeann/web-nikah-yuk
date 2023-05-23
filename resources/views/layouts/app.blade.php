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

        <!-- Logo -->
        <a href="{{ $landingRoute }}" class="logo"><span>Nikah</span>Yuk</a>

        <!-- Navbar -->
        <nav class="navbar">
            @foreach ($routes as $name => $link)
                <a href="{{ $link }}" >{{ $name }}</a>
            @endforeach
        </nav>

        <!-- Menu -->
        <div id="menu-bars" class="fas fa-bars"></div>

    </header>

    <main>
        @yield('content')
    </main>

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
