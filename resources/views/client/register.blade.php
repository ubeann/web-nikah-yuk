@extends('layouts.app')

@section('title', 'Register')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/client/auth.css') }}">
@endsection

@section('content')
    <div class="container">
        <img src="https://source.unsplash.com/random/900x900/?wedding,maried" alt="">

        <div class="form-box">
            <form action="" method="POST">
                <h3>Register</h3>
                <p>Daftar sekarang, raih kenangan tak terlupakan bersama Nikah Yuk! Mulai petualangan romantismu di sini</p>

                @if (session('alert-type') && session('alert-message'))
                    @include('components.alert', ['type' => session('alert-type'), 'message' => session('alert-message')])
                @endif

                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="John Doe">
                    <small>Error message</small>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="example@mail.com">
                    <small>Error message</small>
                </div>

                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" placeholder="08xxxxxxxxxx">
                    <small>Error message</small>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="min. 8 characters">
                    <small>Error message</small>
                </div>

                <div class="input-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="type your password again">
                    <small>Error message</small>
                </div>

                <button type="submit" class="btn">Register</button>
            </form>
        </div>
@endsection
