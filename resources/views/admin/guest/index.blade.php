@extends('layouts.admin-dashboard')

@section('title', 'Guest')

@section('navigation')
    <li>Guest</li>
@endsection

@section('content')
    <div class="card has-table has-mobile-sort-spaced">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-book"></i></span>
                Guests ({{ $guests->total() }})
            </p>
            <a href="javascript:location.reload();" class="card-header-icon">
                <span class="icon"><i class="mdi mdi-reload"></i></span>
            </a>
        </header>
        <div class="card-content">
            @if($guests->isEmpty())
                <section class="section">
                    <div class="content has-text-grey has-text-centered">
                        <p>
                            <span class="icon is-large">
                                <i class="mdi mdi-emoticon-sad mdi-48px"></i>
                            </span>
                        </p>
                        <p>You don't have any guests yet.</p>
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
                                    <th>Event</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Submitted</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guests as $guest)
                                    <tr>
                                        <td class="is-image-cell">
                                            <div class="image">
                                                <img src="https://avatars.dicebear.com/v2/initials/{{ $guest->name }}.svg"
                                                    class="is-rounded">
                                            </div>
                                        </td>
                                        <td data-label="Name">{{ $guest->name }}</td>
                                        <td data-label="Event">
                                            <a href="{{ route('admin.event.detail', $guest->event->id) }}">
                                                {{ $guest->event->name }}
                                            </a>
                                        </td>
                                        <td data-label="Phone">{{ $guest->phone }}</td>
                                        <td data-label="Address">{{ $guest->address }}</td>
                                        <td data-label="Created">
                                            <small class="has-text-grey is-abbr-like" title="{{ $guest->created_at }}">
                                                @if ($guest->created_at->diffInDays() > 30)
                                                    {{ $guest->created_at->format('d M Y') }}
                                                @else
                                                    {{ $guest->created_at->diffForHumans() }}
                                                @endif
                                            </small>
                                        </td>
                                        <td class="is-actions-cell">
                                            <div class="buttons is-right">
                                                <a class="button is-small is-info" href="{{ route('admin.guest.detail', $guest->id) }}">
                                                    <span class="icon"><i class="mdi mdi-eye"></i></span>
                                                </a>
                                                <a class="button is-small is-warning" href="{{ route('admin.guest.edit.form', $guest->id) }}">
                                                    <span class="icon"><i class="mdi mdi-pencil"></i></span>
                                                </a>
                                                <button class="button is-small is-danger jb-modal" data-target="guest-modal-{{ $guest->id }}"
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
                                        @if ($guests->lastPage() > 1)
                                            @for ($i = 1; $i <= $guests->lastPage(); $i++)
                                                {{-- Set page --}}
                                                @php
                                                    $pageShown = 2;
                                                @endphp

                                                {{-- show 10 page, if more add ... --}}
                                                @if ($i == 1 || $i == $guests->lastPage() || ($i >= $guests->currentPage() - $pageShown && $i <= $guests->currentPage() + $pageShown))
                                                    <a href="{{ $guests->url($i) }}"
                                                        class="button {{ $guests->currentPage() == $i ? 'is-active' : '' }}">
                                                        {{ $i }}
                                                    </a>
                                                @endif

                                                {{-- separator --}}
                                                @if ($i == 2 && $guests->currentPage() - $pageShown > 2)
                                                    <span class="button">...</span>
                                                @endif
                                                @if ($i == $guests->currentPage() + $pageShown && $guests->currentPage() + $pageShown < $guests->lastPage())
                                                    <span class="button">...</span>
                                                @endif
                                            @endfor
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="level-right">
                                <div class="level-item">
                                    <small>Page {{ $guests->currentPage() }} of {{ $guests->lastPage() }}</small>
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
    @foreach ($guests as $guest)
        <div id="guest-modal-{{ $guest->id }}" class="modal">
            <div class="modal-background jb-modal-close"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Confirm Delete</p>
                    <button class="delete jb-modal-close" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <p>This will permanently delete <b>{{ $guest->name }}</b> from your database.</p>
                </section>
                <footer class="modal-card-foot">
                    <button class="button jb-modal-close">Cancel</button>
                    <form action="{{ route('admin.guest.delete', $guest->id) }}" method="POST">
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
