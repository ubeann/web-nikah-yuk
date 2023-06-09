@extends('layouts.app')

@section('title', 'Reset Password')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/full-screen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/auth.css') }}">
@endsection

@section('content')
    <div class="container">
        <img src="https://source.unsplash.com/random/900x900/?password" alt="">

        <div class="form-box">
            <form action="{{ route('client.reset-password.submit') }}" method="POST">
                <h3>Reset Password</h3>
                <p>Enter your new password, then confirm it</p>

                @if (session('alert'))
                    @include('components.alert', ['type' => session('alert')['type'], 'message' => session('alert')['message']])
                @elseif ($errors->any())
                    @include('components.alert', ['type' => 'danger', 'message' => 'Token tidak valid'])
                @endif

                @csrf
                <div class="input-group">
                    <input type="hidden" name="token" id="token" placeholder="123456" value="{{ old('token', $token) }}">
                    <small @if($errors->has('token')) class="active" @endif>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('token') }}
                    </small>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="********">
                    <small @if($errors->has('password')) class="active" @endif>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('password') }}
                    </small>
                </div>
                <div class="input-group">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="********">
                    <small @if($errors->has('password_confirmation')) class="active" @endif>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('password_confirmation') }}
                    </small>
                </div>

                <button type="submit" class="btn">Reset Password</button>
            </form>
        </div>
    </div>
@endsection
