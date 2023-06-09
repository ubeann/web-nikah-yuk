@extends('layouts.app')

@section('title', 'Reset Password')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/full-screen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/guest.css') }}">
@endsection

@section('content')
    <div class="guest">
        <h1>Reset Password</h1>
        <p>Hai, {{ $user->name }}! Silahkan klik tombol di bawah ini untuk mereset password akun Anda.</p>

        <a href="{{ $resetPasswordUrl }}" class="btn">Reset Password</a>
    </div>
@endsection
