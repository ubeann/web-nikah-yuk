@extends('layouts.admin-dashboard')

@section('title', 'Detail ' . $client->name)

@section('navigation')
    <li>Client</li>
    <li>Detail {{ $client->name }}</li>
@endsection

@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-information-outline default"></i></span>
                Information of Client
            </p>
            <a href="{{ route('admin.client.edit', $client->id) }}" class="card-header-icon">
                <span class="icon"><i class="mdi mdi-pencil"></i></span>
            </a>
            <button type="button" class="card-header-icon jb-modal" data-target="client-modal-delete">
                <span class="icon"><i class="mdi mdi-delete"></i></span>
            </button>
        </header>
        <div class="card-content">
            <div class="content">
                <p><strong>Name:</strong> {{ $client->name }}</p>
                <p><strong>Email:</strong> {{ $client->email }}</p>
                <p><strong>Phone:</strong> {{ $client->phone }}</p>
                <p><strong>Created At:</strong>
                    {{ $client->created_at->format('d F Y, H:i:s') }}
                    <small class="has-text-grey is-abbr-like">({{ $client->created_at->diffForHumans() }})</small>
                </p>
                <p><strong>Updated At:</strong>
                    {{ $client->updated_at->format('d F Y, H:i:s') }}
                    <small class="has-text-grey is-abbr-like">({{ $client->updated_at->diffForHumans() }})</small>
                </p>
            </div>
        </div>
    </div>

    <div class="card has-table has-mobile-sort-spaced">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-calendar"></i></span>
                Events of {{ $client->name }} ({{ $events->total() }})
            </p>
            <a href="javascript:location.reload();" class="card-header-icon">
                <span class="icon"><i class="mdi mdi-reload"></i></span>
            </a>
        </header>
        <div class="card-content">
            @if($events->isEmpty())
                <section class="section">
                    <div class="content has-text-grey has-text-centered">
                        <p>
                            <span class="icon is-large">
                                <i class="mdi mdi-emoticon-sad mdi-48px"></i>
                            </span>
                        </p>
                        <p>No events found.</p>
                    </div>
                </section>
            @else
                <div class="b-table has-pagination">
                    <div class="table-wrapper has-mobile-cards">
                        <table class="table is-fullwidth is-striped is-hoverable is-sortable is-fullwidth">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Client</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Service</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td class="is-image-cell">
                                            <div class="image">
                                                <img src="https://avatars.dicebear.com/v2/initials/{{ $event->user->name }}.svg" alt="{{ $event->user->name }}"
                                                    class="is-rounded">
                                            </div>
                                        </td>
                                        <td data-label="Client">
                                            <a href="{{ route('admin.client.detail', $event->user->id) }}">
                                                {{ $event->user->name }}
                                            </a>
                                        </td>
                                        <td data-label="Name">{{ $event->name }}</td>
                                        <td data-label="Date">
                                            <small class="has-text-grey is-abbr-like" title="{{ $event->date }}">
                                                {{ $event->date->format('d M Y') }}
                                            </small>
                                        </td>
                                        <td data-label="Service">
                                            <span class="tag is-rounded">
                                                {{ ucwords($event->service) }}
                                            </span>
                                        </td>
                                        <td data-label="Status">
                                            <span class="tag is-rounded
                                            @if ($event->status == 'pending')
                                                is-warning
                                            @elseif (in_array($event->status, ['confirmed', 'completed']))
                                                is-success
                                            @elseif (in_array($event->status, ['canceled', 'rejected']))
                                                is-danger
                                            @endif
                                            ">
                                                {{ $event->status }}
                                            </span>
                                        </td>
                                        <td data-label="Created">
                                            <small class="has-text-grey is-abbr-like" title="{{ $event->created_at }}">
                                                @if ($event->created_at->diffInDays() > 30)
                                                    {{ $event->created_at->format('d M Y') }}
                                                @else
                                                    {{ $event->created_at->diffForHumans() }}
                                                @endif
                                            </small>
                                        </td>
                                        <td class="is-actions-cell">
                                            <div class="buttons is-right">
                                                <a class="button is-small is-info" href="{{ route('admin.event.detail', $event->id) }}">
                                                    <span class="icon"><i class="mdi mdi-eye"></i></span>
                                                </a>
                                                <a class="button is-small is-warning" href="{{ route('admin.event.edit.form', $event->id) }}">
                                                    <span class="icon"><i class="mdi mdi-pencil"></i></span>
                                                </a>
                                                <button class="button is-small is-danger jb-modal" data-target="event-modal-{{ $event->id }}"
                                                    type="button">
                                                    <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="notification">
                        <div class="level">
                            <div class="level-left">
                                <div class="level-item">
                                    <div class="buttons has-addons">
                                        @if ($events->lastPage() > 1)
                                            @for ($i = 1; $i <= $events->lastPage(); $i++)
                                                {{-- Set page --}}
                                                @php
                                                    $pageShown = 2;
                                                @endphp

                                                {{-- show 10 page, if more add ... --}}
                                                @if ($i == 1 || $i == $events->lastPage() || ($i >= $events->currentPage() - $pageShown && $i <= $events->currentPage() + $pageShown))
                                                    <a href="{{ $events->url($i) }}"
                                                        class="button {{ $events->currentPage() == $i ? 'is-active' : '' }}">
                                                        {{ $i }}
                                                    </a>
                                                @endif

                                                {{-- separator --}}
                                                @if ($i == 2 && $events->currentPage() - $pageShown > 2)
                                                    <span class="button">...</span>
                                                @endif
                                                @if ($i == $events->currentPage() + $pageShown && $events->currentPage() + $pageShown < $events->lastPage())
                                                    <span class="button">...</span>
                                                @endif
                                            @endfor
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="level-right">
                                <div class="level-item">
                                    <small>Page {{ $events->currentPage() }} of {{ $events->lastPage() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('modal')
    <div id="client-modal-delete" class="modal">
        <div class="modal-background jb-modal-close"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Confirm Delete</p>
                <button class="delete jb-modal-close" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <p>This will permanently delete <b>{{ $client->name }}</b> from your database.</p>
            </section>
            <footer class="modal-card-foot">
                <button class="button jb-modal-close">Cancel</button>
                <form action="{{ route('admin.client.delete', $client->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="button is-danger jb-modal-close">Delete</button>
                </form>
            </footer>
        </div>
        <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
    </div>

    @foreach ($events as $event)
        <div id="event-modal-{{ $event->id }}" class="modal">
            <div class="modal-background jb-modal-close"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Confirm Delete</p>
                    <button class="delete jb-modal-close" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <p>This will permanently delete <b>{{ $event->name }}</b> from your database.</p>
                </section>
                <footer class="modal-card-foot">
                    <button class="button jb-modal-close">Cancel</button>
                    <form action="{{ route('admin.event.delete', $event->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="button is-danger jb-modal-close">Delete</button>
                    </form>
                </footer>
            </div>
            <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
        </div>
    @endforeach
@endsection
