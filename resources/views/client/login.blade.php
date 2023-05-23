@extends('layouts.app')

@section('title', 'Login')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/client/auth.css') }}">
@endsection

@section('content')
    <div class="container">
        <img src="https://source.unsplash.com/random/900x900/?wedding,maried" alt="">

        <div class="form-box">
            <form action="" method="POST">
                <h3>Login</h3>
                <p>Langsung Gaspol! Ayo, masuk ke portal Nikah Yuk! Siap-siap merajut kisah cinta yang penuh warna</p>

                @if (session('alert-type') && session('alert-message'))
                    @include('components.alert', ['type' => session('alert-type'), 'message' => session('alert-message')])
                @endif

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="example@mail.com">
                    <small>Error message</small>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="min. 8 characters">
                    <small>Error message</small>
                </div>

                <div class="checkbox">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>
@endsection
