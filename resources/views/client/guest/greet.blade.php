@extends('layouts.app')

@section('title', 'Registration' . ($event ? ' of ' . $event->name . ' complete' : ''))

@section('css')
    <link rel="stylesheet" href="{{ asset('css/full-screen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/guest.css') }}">
@endsection

@section('content')
    <div class="guest">
        <h1>Registration
            @if ($event)
                of {{ $event->name }} complete
            @endif
        </h1>

        @if (session('alert'))
            @include('components.alert', ['type' => session('alert')['type'], 'message' => session('alert')['message']])
        @elseif ($errors->any())
            @include('components.alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan, silahkan coba lagi atau hubungi admin'])
        @elseif ($event == null)
            @include('components.alert', ['type' => 'danger', 'message' => 'Event tidak ditemukan'])
        @endif

        @if($event)
            <p class="description">Terima kasih telah mengkonfirmasi kehadiran anda pada acara {{ $event->name }}.</p>

            <a href="{{ route('client.guest.form', $event->guest_url) }}" class="btn">Isi Formulir Lagi</a>
        @endif
    </div>
@endsection
