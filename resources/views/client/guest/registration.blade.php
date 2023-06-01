@extends('layouts.app')

@section('title', 'Guest Registration' . ($event ? ' of ' . $event->name : ''))

@section('css')
    <link rel="stylesheet" href="{{ asset('css/full-screen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/guest.css') }}">
@endsection

@section('content')
    <div class="guest">
        <h1>Guest Registration
            @if ($event)
                of {{ $event->name }}
            @endif
        </h1>

        @if($event)
            <p class="description">Silahkan isi form dibawah ini untuk mengkonfirmasi kehadiran anda pada acara {{ $event->name }}.</p>
        @endif

        @if (session('alert'))
            @include('components.alert', ['type' => session('alert')['type'], 'message' => session('alert')['message']])
        @elseif ($errors->any())
            @include('components.alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan, silahkan coba lagi atau hubungi admin'])
        @elseif ($event == null)
            @include('components.alert', ['type' => 'danger', 'message' => 'Event tidak ditemukan'])
        @endif

        @if($event)
            <div class="form-box">
                <form action="{{ route('client.guest.submit', ['id' => $event->guest_url]) }}" method="POST">
                    @csrf

                    <div class="input-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" placeholder="{{ fake()->name }}" value="{{ old('name') }}">
                        <small @if($errors->has('name')) class="active" @endif>
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('name') }}
                        </small>
                    </div>
                    <div class="input-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" placeholder="{{ fake()->phoneNumber }}" value="{{ old('phone') }}">
                        <small @if($errors->has('phone')) class="active" @endif>
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('phone') }}
                        </small>
                    </div>
                    <div class="input-group">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" placeholder="{{ fake()->address }}">{{ old('address') }}</textarea>
                        <small @if($errors->has('address')) class="active" @endif>
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('address') }}
                        </small>
                    </div>

                    <div class="buttons-box">
                        <button type="submit" class="btn">Submit</button>
                    </div>
                </form>
            </div>
        @endif
    </div>
@endsection
