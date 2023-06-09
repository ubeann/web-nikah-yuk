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
            <form action="{{ route('client.forgot-password.submit') }}" method="POST">
                <h3>Forgot Password</h3>
                <p>Enter your email address to reset your password</p>

                @if (session('alert'))
                    @include('components.alert', ['type' => session('alert')['type'], 'message' => session('alert')['message']])
                @elseif ($errors->any())
                    @include('components.alert', ['type' => 'danger', 'message' => 'Email tidak terdaftar'])
                @endif

                @csrf

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="example@mail.com">
                    <small @if($errors->has('email')) class="active" @endif>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('email') }}
                    </small>
                </div>

                <button type="submit" class="btn">Send Email</button>
            </form>
        </div>
    </div>
@endsection
