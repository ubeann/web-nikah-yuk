<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>
        Admin
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
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Include your CSS stylesheets here -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.min.css') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- CSS -->
    @yield('css')
</head>

<body>

    <!-- App -->
    <div id="app">
        <!-- Header -->
        <nav id="navbar-main" class="navbar is-fixed-top">
            <div class="navbar-brand">
                <a class="navbar-item is-hidden-desktop jb-aside-mobile-toggle">
                    <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
                </a>
            </div>
            <div class="navbar-brand is-right">
                <a class="navbar-item is-hidden-desktop jb-navbar-menu-toggle" data-target="navbar-menu">
                    <span class="icon"><i class="mdi mdi-dots-vertical"></i></span>
                </a>
            </div>
            <div class="navbar-menu fadeIn animated faster" id="navbar-menu">
                <div class="navbar-end">
                    <div class="navbar-item has-dropdown has-dropdown-with-icons has-divider has-user-avatar is-hoverable">
                        <a class="navbar-link is-arrowless">
                            <div class="is-user-avatar">
                                <img src="https://avatars.dicebear.com/v2/initials/{{ Auth::guard('admin')->user()->username }}.svg" alt="{{ Auth::guard('admin')->user()->username }}">
                            </div>
                            <div class="is-user-name"><span>{{ ucwords(Auth::guard('admin')->user()->username) }}</span></div>
                            <span class="icon"><i class="mdi mdi-chevron-down"></i></span>
                        </a>
                        <div class="navbar-dropdown">
                            {{-- TODO: Setting --}}
                            <a class="navbar-item" href="{{ route('admin.settings.form') }}">
                                <span class="icon"><i class="mdi mdi-settings"></i></span>
                                <span>Settings</span>
                            </a>
                            <a class="navbar-item" href="{{ route('admin.logout') }}">
                                <span class="icon"><i class="mdi mdi-logout"></i></span>
                                <span>Log Out</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Menu -->
        <aside class="aside is-placed-left is-expanded">
            <!-- Head -->
            <div class="aside-tools">
                <div class="aside-tools-label">
                    @if( !request()->is('admin') && redirect()->back()->getTargetUrl() != route('admin.login.form'))
                    <a class="iconn" style="color: white;" href="{{ redirect()->back()->getTargetUrl() }}">
                        <i class="mdi mdi-arrow-left"></i>
                    </a>
                    @endif
                    <span><b>Admin</b> Dashboard</span>
                </div>
            </div>

            <!-- List -->
            <div class="menu is-menu-main">

                <!-- General -->
                <p class="menu-label">General</p>
                <ul class="menu-list">
                    <li>
                        <a class="router-link-active has-icon {{ request()->is('admin') ? 'is-active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
                            <span class="menu-item-label">Dashboard</span>
                        </a>
                    </li>
                </ul>

                <!-- Menu -->
                {{-- TODO: Setting Menu --}}
                <p class="menu-label">Menu</p>
                <ul class="menu-list">
                    <li>
                        <a class="has-icon">
                            <span class="icon">
                                <i class="mdi mdi-account-multiple"></i>
                            </span>
                            <span class="menu-item-label">Clients</span>
                        </a>
                    </li>
                </ul>

                <!-- Security -->
                <p class="menu-label">Security</p>
                <ul class="menu-list">
                    <li>
                        <a class="has-icon {{ request()->is('admin/settings') ? 'is-active' : '' }}"
                            href="{{ route('admin.settings.form') }}">
                            <span class="icon">
                                <i class="mdi mdi-settings"></i>
                            </span>
                            <span class="menu-item-label">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a class="has-icon" href="{{ route('admin.logout') }}">
                            <span class="icon">
                                <i class="mdi mdi-logout"></i>
                            </span>
                            <span class="menu-item-label">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Title Bar -->
        <section class="section is-title-bar">
            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <ul>
                            <li>Admin</li>
                            @yield('navigation')
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Hero Bar -->
        <section class="hero is-hero-bar">
            <div class="hero-body">
                <div class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <h1 class="title">
                                @yield('title')
                            </h1>
                        </div>
                    </div>
                    <div class="level-right" style="display: none;">
                        <div class="level-item"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main -->
        <section class="section is-main-section">
            <!-- Success -->
            @if (session('success'))
            <div class="notification is-success">
                <button class="delete jb-notification-dismiss"></button>
                {{ session('success') }}
            </div>
            @endif

            <!-- Error -->
            @if (session('error'))
                <div class="notification is-danger">
                    <button class="delete jb-notification-dismiss"></button>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Warning -->
            @if (session('warning'))
                <div class="notification is-warning">
                    <button class="delete jb-notification-dismiss"></button>
                    {{ session('warning') }}
                </div>
            @endif

            @yield('content')
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="level">
                    <div class="level-left">
                        <div class="level-item">
                            © 2020, JustBoil.me
                        </div>
                        <div class="level-item">
                            <a href="https://github.com/vikdiesel/admin-one-bulma-dashboard" style="height: 20px">
                                <img
                                    src="https://img.shields.io/github/v/release/vikdiesel/admin-one-bulma-dashboard?color=%23999">
                            </a>
                        </div>
                    </div>
                    <div class="level-right">
                        <div class="level-item">
                            <div class="logo">
                                <a href="https://justboil.me"><img src="{{ asset('img/justboil-logo.svg') }}" alt="JustBoil.me"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Modal -->
    @yield('modal')

    <!-- Include your JavaScript files here -->
    <script type="text/javascript" src="{{ asset('js/admin/dashboard.min.js') }}"></script>


    <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

    <!-- JavaScript -->
    @yield('js')
</body>

</html>
