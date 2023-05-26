@extends('layouts.app')

@section('title', 'Profile')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/full-screen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/profile.css') }}">
@endsection

@section('content')
    <div class="profile">
        <h1>Profile</h1>

        @if (session('alert'))
            @include('components.alert', ['type' => session('alert')['type'], 'message' => session('alert')['message']])
        @elseif ($errors->any())
            @include('components.alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan, silahkan coba lagi atau hubungi admin'])
        @endif

        <div class="container">

            <!-- Profile Form Edit -->
            <div class="form-box">
                <form action="{{ route('client.profile.update.profile') }}" method="POST">
                    <h2>
                        <i class="fas fa-user"></i>
                        Edit Profile
                    </h2>

                    @csrf
                    @method('PUT')

                    <div class="input-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" placeholder="John Doe" value="{{ old('name') ?? $user->name }}">
                        <small @if($errors->has('name')) class="active" @endif>
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('name') }}
                        </small>
                    </div>

                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="example@mail.com" value="{{ old('email') ?? $user->email }}">
                        <small @if($errors->has('email')) class="active" @endif>
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('email') }}
                        </small>
                    </div>

                    <div class="input-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" id="phone" placeholder="08xxxxxxxxxx" value="{{ old('phone') ?? $user->phone }}">
                        <small @if($errors->has('phone')) class="active" @endif>
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('phone') }}
                        </small>
                    </div>

                    <div class="buttons-box">
                        <button type="submit" class="btn">Simpan</button>
                    </div>

                </form>
            </div>

            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-image">
                    <img src="https://avatars.dicebear.com/v2/initials/{{ $user->name }}.svg" alt="{{ $user->name }}">
                </div>
                <div class="profile-information">
                    <h3>{{ ucwords($user->name) }}</h3>
                    <div class="profile-data">
                        <i class="fas fa-envelope"></i>
                        <p>{{ $user->email }}</p>
                    </div>
                    <div class="profile-data">
                        <i class="fas fa-phone"></i>
                        <p class="phone">{{ $user->phone }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-box form-password">
            <form action="{{ route('client.profile.update.password') }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin mengganti password?')">
                <h2>
                    <i class="fas fa-lock"></i>
                    Change Password
                </h2>

                @csrf
                @method('PATCH')

                <div class="input-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password" placeholder="Current Password">
                    <small @if($errors->has('current_password')) class="active" @endif>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('current_password') }}
                    </small>
                </div>

                <div class="input-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" id="password" placeholder="New Password">
                    <small @if($errors->has('password')) class="active" @endif>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('password') }}
                    </small>
                </div>

                <div class="input-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm New Password">
                    <small @if($errors->has('password_confirmation')) class="active" @endif>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('password_confirmation') }}
                    </small>
                </div>

                <div class="buttons-box">
                    <button type="submit" class="btn">Ganti Password</button>
                </div>

            </form>
        </div>
    </div>
@endsection
