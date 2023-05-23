@extends('layouts.app')

@section('title', 'Register')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/client/auth.css') }}">
@endsection

@section('content')
    <div class="container">
        <img src="https://source.unsplash.com/random/900x900/?wedding,maried" alt="">

        <div class="form-box">
            <form action="{{ route('client.register.submit') }}" method="POST">
                <h3>Register</h3>
                <p>Daftar sekarang, raih kenangan tak terlupakan bersama Nikah Yuk! Mulai petualangan romantismu di sini</p>

                @if (session('alert'))
                    @include('components.alert', ['type' => session('alert')['type'], 'message' => session('alert')['message']])
                @elseif ($errors->any())
                    @include('components.alert', ['type' => 'danger', 'message' => 'Registrasi gagal, silahkan cek kembali data anda'])
                @endif

                @csrf

                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="John Doe" value="{{ old('name') }}">
                    <small @if($errors->has('name')) class="active" @endif>
                        {{ $errors->first('name') }}
                    </small>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="example@mail.com" value="{{ old('email') }}">
                    <small @if($errors->has('email')) class="active" @endif>
                        {{ $errors->first('email') }}
                    </small>
                </div>

                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}">
                    <small @if($errors->has('phone')) class="active" @endif>
                        {{ $errors->first('phone') }}
                    </small>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="min. 8 characters">
                    <small @if($errors->has('password')) class="active" @endif>
                        {{ $errors->first('password') }}
                    </small>
                </div>

                <div class="input-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="type your password again">
                    <small @if($errors->has('password_confirmation')) class="active" @endif>
                        {{ $errors->first('password_confirmation') }}
                    </small>
                </div>

                <button type="submit" class="btn">Register</button>

                <div class="link">
                    <p>Sudah punya akun? <a href="{{ route('client.login.form') }}">Login</a></p>
                </div>

            </form>
        </div>
@endsection
