<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>Admin Login</title>

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

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/auth.css') }}">
</head>

<body>
    <!-- Container -->
    <main class="container">
        <!-- Thumbnail -->
        <div class="thumbnail">
            <h1>
                <i class="fas fa-user-shield"></i>
                Administrator
            </h1>
        </div>

        <!-- Form -->
        <div class="form-box">
            <form action="{{ route('admin.login.submit') }}" method="POST">
                <h1>Login</h1>

                @if (session('alert'))
                    @include('components.alert', ['type' => session('alert')['type'], 'message' => session('alert')['message']])
                @elseif ($errors->any())
                    @include('components.alert', ['type' => 'danger', 'message' => 'Login gagal, silahkan cek kembali email dan password anda'])
                @endif

                @csrf

                <!-- Email -->
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="example@mail.com" value="{{ old('email') }}">
                    <small @if($errors->has('email')) class="active" @endif>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('email') }}
                    </small>
                </div>

                <!-- Password -->
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="min. 8 characters">
                    <small @if($errors->has('password')) class="active" @endif>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('password') }}
                    </small>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn">Login</button>
            </form>
        </div>

    </main>

    <!-- Footer -->
    <footer>
        <p>
            Nikah Yuk &copy; {{ date('Y') }} - All Right Reserved
        </p>
    </footer>

    <!-- JavaScript -->
    <script src="{{ asset('js/admin/auth.js') }}"></script>
</body>

</html>
