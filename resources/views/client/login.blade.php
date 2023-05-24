@extends('layouts.app')

@section('title', 'Login')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/client/auth.css') }}">
@endsection

@section('content')
    <div class="container">
        <img src="https://source.unsplash.com/random/900x900/?wedding,maried" alt="">

        <div class="form-box">
            <form action="{{ route('client.login.submit') }}" method="POST">
                <h3>Login</h3>
                <p>Langsung Gaspol! Ayo, masuk ke portal Nikah Yuk! Siap-siap merajut kisah cinta yang penuh warna</p>

                @if (session('alert'))
                    @include('components.alert', ['type' => session('alert')['type'], 'message' => session('alert')['message']])
                @elseif ($errors->any())
                    @include('components.alert', ['type' => 'danger', 'message' => 'Login gagal, silahkan cek kembali email dan password anda'])
                @endif

                @csrf

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="example@mail.com">
                    <small @if($errors->has('email')) class="active" @endif>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('email') }}
                    </small>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="min. 8 characters">
                    <small @if($errors->has('password')) class="active" @endif>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('password') }}
                    </small>
                </div>

                <div class="checkbox">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn">Login</button>

                <div class="link">
                    <p>Belum punya akun? <a href="{{ route('client.register.form') }}">Register</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
