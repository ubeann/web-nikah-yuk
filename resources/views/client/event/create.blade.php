@extends('layouts.app')

@section('title', 'Create Event')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/full-screen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/event/create.css') }}">
@endsection

@section('content')
    <div class="event">
        <h1>Create Event</h1>

        @if (session('alert'))
            @include('components.alert', ['type' => session('alert')['type'], 'message' => session('alert')['message']])
        @elseif ($errors->any())
            @include('components.alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan, silahkan coba lagi atau hubungi admin'])
        @endif

        <div class="form-box">
            <form action="{{ route('client.event.create.submit') }}" method="POST">
                @csrf

                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="{{ 'Pernikahan ' . auth()->user()->name }}" value="{{ old('name') }}">
                    <small @if($errors->has('name')) class="active" @endif>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('name') }}
                    </small>
                </div>

                <div class="input-group">
                    <label for="service">Service</label>
                    <select name="service" id="service">
                        <option value="" disabled selected>Choose Service</option>
                        <option value="kilat" @if(old('service') == 'kilat') selected @endif>Kilat (Rp. 8.000.000)</option>
                        <option value="xpress" @if(old('service') == 'xpress') selected @endif>Xpress (Rp. 12.000.000)</option>
                        <option value="honeymoon" @if(old('service') == 'honeymoon') selected @endif>Honeymoon (Rp. 18.000.000)</option>
                        <option value="custom" @if(old('service') == 'custom') selected @endif>Custom (Tarif Menyesuaikan)</option>
                    </select>
                    <small @if($errors->has('service')) class="active" @endif>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('service') }}
                    </small>
                </div>

                <div class="input-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" value="{{ old('date') }}">
                    <small @if($errors->has('date')) class="active" @endif>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('date') }}
                    </small>
                </div>

                <div class="input-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" id="location" placeholder="Jakarta" value="{{ old('location') }}">
                    <small @if($errors->has('location')) class="active" @endif>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('location') }}
                    </small>
                </div>

                <div class="input-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" placeholder="Description">{{ old('description') }}</textarea>
                    <small @if($errors->has('description')) class="active" @endif>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('description') }}
                    </small>
                </div>

                <div class="buttons-box">
                    <button type="submit" class="btn">Create Event</button>
                </div>
            </form>
        </div>
    </div>
@endsection
