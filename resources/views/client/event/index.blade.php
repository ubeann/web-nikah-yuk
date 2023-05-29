@extends('layouts.app')

@section('title', 'Event')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/full-screen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/event/index.css') }}">
@endsection

@section('content')
    <div class="event">
        <h1>Event</h1>

        @if (session('alert'))
            @include('components.alert', ['type' => session('alert')['type'], 'message' => session('alert')['message']])
        @elseif ($errors->any())
            @include('components.alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan, silahkan coba lagi atau hubungi admin'])
        @endif

        <div class="container">
            <div class="title">
                <h2>
                    <i class="fas fa-calendar-alt"></i>
                    List Event
                    @if($events->count() > 0)
                        ({{ $events->count() }})
                    @endif
                </h2>

                <a href="{{ route('client.event.create.form') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Create Event
                </a>
            </div>

            <!-- Table list of event -->
            <div class="table-box">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $event)
                            <tr>
                                <td data-label="No:">{{ $loop->iteration }}</td>
                                <td data-label="Name:">{{ $event->name }}</td>
                                <td data-label="Date:">{{ (new DateTime($event->date))->format('d F Y') }}</td>
                                <td data-label="Type:">{{ ucfirst($event->service) }}</td>
                                <td data-label="Status:">
                                    <span class="status status-{{ $event->status }}">
                                        {{ $event->status }}
                                    </span>
                                </td>
                                <td data-label="Action:">
                                    <!-- Detail button -->
                                    <a href="{{ route('client.event.detail', ['id' => $event->id]) }}" class="btn btn-info">
                                        <i class="fas fa-info-circle"></i>
                                    </a>

                                    @if($event->status == 'pending')
                                        <!-- Edit button -->
                                        <a href="{{ route('client.event.edit.form', ['id' => $event->id]) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Delete button -->
                                        <form action="{{ route('client.event.delete', ['id' => $event->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
