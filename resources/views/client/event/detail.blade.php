@extends('layouts.app')

@section('title', 'Event ' . $event->name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/full-screen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/event/detail.css') }}">
@endsection

@section('content')
    <div class="event">
        <h1>Event {{ $event->name }}</h1>

        <div class="container">
            <div class="title">
                <h2>
                    <i class="fas fa-info-circle"></i>
                    Detail Event
                </h2>
            </div>

            <div class="list">
                <div class="item">
                    <div class="label">
                        <p>Name</p>
                    </div>
                    <div class="value">
                        {{ $event->name }}
                    </div>
                </div>

                <div class="item">
                    <div class="label">
                        <p>Date</p>
                    </div>
                    <div class="value">
                        {{ (new DateTime($event->date))->format('d F Y') }}
                    </div>
                </div>

                <div class="item">
                    <div class="label">
                        <p>Status</p>
                    </div>
                    <div class="value">
                        <span class="status status-{{ $event->status }}">
                            {{ $event->status }}
                        </span>
                    </div>
                </div>

                <div class="item">
                    <div class="label">
                        <p>Type</p>
                    </div>
                    <div class="value">
                        {{ ucfirst($event->service) }}
                    </div>
                </div>

                <div class="item">
                    <div class="label">
                        <p>Price</p>
                    </div>
                    <div class="value">
                        {{ $event->price }}
                    </div>
                </div>

                <div class="item">
                    <div class="label">
                        <p>Location</p>
                    </div>
                    <div class="value">
                        {{ $event->location }}
                    </div>
                </div>

                <div class="item">
                    <div class="label">
                        <p>Description</p>
                    </div>
                    <div class="value">
                        {{ $event->description }}
                    </div>
                </div>

                @if($event->status == 'pending')
                    <div class="item">
                        <div class="label">
                            <p>Action</p>
                        </div>
                        <div class="value">
                            <!-- Edit button -->
                            <a href="{{ route('client.event.edit.form', ['id' => $event->id]) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>

                            <!-- Delete button -->
                            <form action="{{ route('client.event.delete', ['id' => $event->id]) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin membatalkan event ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="container">
            <div class="title">
                <h2>
                    <i class="fas fa-users"></i>
                    Guest List
                </h2>
            </div>
        </div>
    </div>
@endsection
