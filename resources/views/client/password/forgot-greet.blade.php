@extends('layouts.app')

@section('title', 'Forgot Password')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/full-screen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/auth.css') }}">
@endsection

@section('content')
    <div class="container">
        <img src="https://source.unsplash.com/random/900x900/?account" alt="">

        <div class="form-box">
            <form>
                <h3>We have sent an email to your email address</h3>
                <p>Please check your email to reset your password</p>

                <a href="{{ route('client.login.form') }}" class="btn">Back to Login</a>
            </form>
        </div>
    </div>
@endsection
