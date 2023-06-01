@extends('layouts.admin-dashboard')

@section('title', 'Dashboard')

@section('navigation')
    <li>Dashboard</li>
@endsection

@section('content')
    <!-- Card -->
    <div class="tile is-ancestor">
        <!-- Client -->
        <div class="tile is-parent">
            <div class="card tile is-child">
                <div class="card-content">
                    <div class="level is-mobile">
                        <div class="level-item">
                            <div class="is-widget-label">
                                <h3 class="subtitle is-spaced">
                                    Clients
                                </h3>
                                <h1 class="title">
                                    {{ $card['client'] }}
                                </h1>
                            </div>
                        </div>
                        <div class="level-item has-widget-icon">
                            <div class="is-widget-icon">
                                <span class="icon has-text-primary is-large">
                                    <i class="mdi mdi-account-multiple mdi-48px"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Events -->
        <div class="tile is-parent">
            <div class="card tile is-child">
                <div class="card-content">
                    <div class="level is-mobile">
                        <div class="level-item">
                            <div class="is-widget-label">
                                <h3 class="subtitle is-spaced">
                                    Events
                                </h3>
                                <h1 class="title">
                                    {{ $card['event'] }}
                                </h1>
                            </div>
                        </div>
                        <div class="level-item has-widget-icon">
                            <div class="is-widget-icon">
                                <span class="icon has-text-danger is-large">
                                    <i class="mdi mdi-calendar-multiple mdi-48px"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Guests -->
        <div class="tile is-parent">
            <div class="card tile is-child">
                <div class="card-content">
                    <div class="level is-mobile">
                        <div class="level-item">
                            <div class="is-widget-label">
                                <h3 class="subtitle is-spaced">
                                    Guests
                                </h3>
                                <h1 class="title">
                                    {{ $card['guest'] }}
                                </h1>
                            </div>
                        </div>
                        <div class="level-item has-widget-icon">
                            <div class="is-widget-icon">
                                <span class="icon has-text-info is-large">
                                    <i class="mdi mdi-book mdi-48px"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Client Tabel -->
    <div class="card has-table has-mobile-sort-spaced">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                Clients
            </p>
            <a href="#" class="card-header-icon">
                <span class="icon"><i class="mdi mdi-reload"></i></span>
            </a>
        </header>
        <div class="card-content">
            @if($clients->isEmpty())
                <section class="section">
                    <div class="content has-text-grey has-text-centered">
                        <p>
                            <span class="icon is-large">
                                <i class="mdi mdi-emoticon-sad mdi-48px"></i>
                            </span>
                        </p>
                        <p>You don't have any clients yet.</p>
                    </div>
                </section>
            @else
                <div class="b-table has-pagination">
                    <div class="table-wrapper has-mobile-cards">
                        <table class="table is-fullwidth is-striped is-hoverable is-sortable is-fullwidth">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Created</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td class="is-image-cell">
                                            <div class="image">
                                                <img src="https://avatars.dicebear.com/v2/initials/{{ $client->name }}.svg"
                                                    class="is-rounded">
                                            </div>
                                        </td>
                                        <td data-label="Name">{{ $client->name }}</td>
                                        <td data-label="Email">{{ $client->email }}</td>
                                        <td data-label="Phone">{{ $client->phone }}</td>
                                        <td data-label="Created">
                                            <small class="has-text-grey is-abbr-like" title="{{ $client->created_at }}">
                                                @if ($client->created_at->diffInDays() > 30)
                                                    {{ $client->created_at->format('d M Y') }}
                                                @else
                                                    {{ $client->created_at->diffForHumans() }}
                                                @endif
                                            </small>
                                        </td>
                                        <td class="is-actions-cell">
                                            <div class="buttons is-right">
                                                <a class="button is-small is-info" href="{{ route('admin.client.detail', $client->id) }}">
                                                    <span class="icon"><i class="mdi mdi-eye"></i></span>
                                                </a>
                                                <a class="button is-small is-warning" href="{{ route('admin.client.edit', $client->id) }}">
                                                    <span class="icon"><i class="mdi mdi-pencil"></i></span>
                                                </a>
                                                <button class="button is-small is-danger jb-modal" data-target="client-modal-{{ $client->id }}"
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
                                        @if ($clients->lastPage() > 1)
                                            @for ($i = 1; $i <= $clients->lastPage(); $i++)
                                                {{-- Set page --}}
                                                @php
                                                    $pageShown = 2;
                                                @endphp

                                                {{-- show 10 page, if more add ... --}}
                                                @if ($i == 1 || $i == $clients->lastPage() || ($i >= $clients->currentPage() - $pageShown && $i <= $clients->currentPage() + $pageShown))
                                                    <a href="{{ $clients->url($i) }}"
                                                        class="button {{ $clients->currentPage() == $i ? 'is-active' : '' }}">
                                                        {{ $i }}
                                                    </a>
                                                @endif

                                                {{-- separator --}}
                                                @if ($i == 2 && $clients->currentPage() - $pageShown > 2)
                                                    <span class="button">...</span>
                                                @endif
                                                @if ($i == $clients->currentPage() + $pageShown && $clients->currentPage() + $pageShown < $clients->lastPage())
                                                    <span class="button">...</span>
                                                @endif
                                            @endfor
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="level-right">
                                <div class="level-item">
                                    <small>Page {{ $clients->currentPage() }} of {{ $clients->lastPage() }}</small>
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
    @foreach ($clients as $client)
        <div id="client-modal-{{ $client->id }}" class="modal">
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
    @endforeach
@endsection
