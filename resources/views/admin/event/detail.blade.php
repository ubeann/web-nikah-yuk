@extends('layouts.admin-dashboard')

@section('title', 'Detail ' . $event->name)

@section('navigation')
    <li>Event</li>
    <li>Detail {{ $event->name }}</li>
@endsection

@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-information-outline default"></i></span>
                Information of Event
            </p>
            <a href="{{ route('admin.event.edit.form', $event->id) }}" class="card-header-icon">
                <span class="icon"><i class="mdi mdi-pencil"></i></span>
            </a>
            <button type="button" class="card-header-icon jb-modal" data-target="event-modal-delete">
                <span class="icon"><i class="mdi mdi-delete"></i></span>
            </button>
        </header>
        <div class="card-content">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Client</label>
                </div>
                <div class="field-body" style="display: flex; align-items: flex-end;">
                    <div class="field">
                        <div class="control">
                            <a href="{{ route('admin.client.detail', $event->user->id) }}">
                                {{ $event->user->name }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Name</label>
                </div>
                <div class="field-body" style="display: flex; align-items: flex-end;">
                    <div class="field">
                        <div class="control">
                            <span>{{ $event->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Service</label>
                </div>
                <div class="field-body" style="display: flex; align-items: flex-end;">
                    <div class="field">
                        <div class="control">
                            <span class="tag is-rounded">{{ ucwords($event->service) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Status</label>
                </div>
                <div class="field-body" style="display: flex; align-items: flex-end;">
                    <div class="field">
                        <div class="control">
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Guest URL</label>
                </div>
                <div class="field-body" style="display: flex; align-items: flex-end;">
                    <div class="field">
                        <div class="control">
                            @if($event->guest_url)
                                <a href="{{ route('client.guest.form', $event->guest_url) }}">{{ $event->guest_url }}</a>
                            @else
                                <span class="tag is-rounded is-danger">Not Set</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Price</label>
                </div>
                <div class="field-body" style="display: flex; align-items: flex-end;">
                    <div class="field">
                        <div class="control">
                            <span>{{ $event->price }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Date</label>
                </div>
                <div class="field-body" style="display: flex; align-items: flex-end;">
                    <div class="field">
                        <div class="control">
                            <span>{{ $event->date->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Location</label>
                </div>
                <div class="field-body" style="display: flex; align-items: flex-end;">
                    <div class="field">
                        <div class="control">
                            <span>{{ $event->location }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Description</label>
                </div>
                <div class="field-body" style="display: flex; align-items: flex-end;">
                    <div class="field">
                        <div class="control">
                            <span>{{ $event->description }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Created At</label>
                </div>
                <div class="field-body" style="display: flex; align-items: flex-end;">
                    <div class="field">
                        <div class="control">
                            <span>
                                {{ $event->created_at->format('d F Y, H:i:s') }}
                                <small class="has-text-grey is-abbr-like">({{ $event->created_at->diffForHumans() }})</small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Updated At</label>
                </div>
                <div class="field-body" style="display: flex; align-items: flex-end;">
                    <div class="field">
                        <div class="control">
                            <span>
                                {{ $event->updated_at->format('d F Y, H:i:s') }}
                                <small class="has-text-grey is-abbr-like">({{ $event->updated_at->diffForHumans() }})</small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            @if($event->status != 'canceled')
                <hr>
                <div class="field is-grouped is-grouped-right">
                    @if($event->status != 'rejected')
                        <p class="control">
                            <button type="button" class="button is-danger jb-modal" data-target="event-modal-reject">
                                Reject
                            </button>
                        </p>
                    @endif
                    @if($event->status != 'confirmed')
                        <p class="control">
                            <button class="button is-primary jb-modal" data-target="event-modal-confirm">
                                Confirm
                            </button>
                        </p>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <div class="card has-table has-mobile-sort-spaced">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-book"></i></span>
                Guests of {{ $event->name }} ({{ $guests->total() }})
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

    <div class="columns is-multiline">
        <div class="column is-12">
            <h1 class="title is-4">
                <span class="icon"><i class="mdi mdi-image-multiple"></i></span>
                Photos of {{ $event->name }} ({{ $photos->total() }})
            </h1>
        </div>

        @if ($photos->isEmpty())
            <div class="column is-12">
                <div class="notification is-warning">
                    No photos found.
                </div>
            </div>
        @else
            @foreach ($photos as $photo)
                <div class="column is-4">
                    <div class="card">
                        <div class="card-image">
                        <figure class="image is-4by3 is-cover">
                            <img src="{{ asset($photo->url) }}" alt="{{ $photo->filename }}" style="object-fit: cover; object-position: center; width: 100%; height: 100%;">
                        </figure>
                        </div>
                        <div class="card-content is-overlay">
                        <span class="tag is-primary">{{ $photo->event->name }}</span>
                            <a href="{{ asset($photo->url) }}" download="{{ $photo->filename }}" class="button is-primary is-pulled-right">
                                <span class="icon"><i class="mdi mdi-download"></i></span>
                            </a>
                        <button class="button is-danger jb-modal is-pulled-right mx-2" type="button" data-target="photo-modal-{{ $photo->id }}">
                            <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                        </button>
                        </div>
                        <div class="card-footer">
                            {{-- <p class="card-footer-item">
                                <span>
                                    <span class="icon"><i class="mdi mdi-clock"></i></span>
                                    @if ($photo->created_at->diffInDays() > 30)
                                        {{ $photo->created_at->format('d M Y') }}
                                    @else
                                        {{ $photo->created_at->diffForHumans() }}
                                    @endif
                                </span>
                            </p> --}}
                            <p class="card-footer-item">
                                <span>
                                    <span class="icon"><i class="mdi mdi-file"></i></span>
                                    {{ $photo->filename }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="column is-12">
                <div class="notification">
                    <div class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <div class="buttons has-addons">
                                    @if ($photos->lastPage() > 1)
                                        @for ($i = 1; $i <= $photos->lastPage(); $i++)
                                            {{-- Set page --}}
                                            @php
                                                $pageShown = 2;
                                            @endphp

                                            {{-- show 10 page, if more add ... --}}
                                            @if ($i == 1 || $i == $photos->lastPage() || ($i >= $photos->currentPage() - $pageShown && $i <= $photos->currentPage() + $pageShown))
                                                <a href="{{ $photos->url($i) }}"
                                                    class="button {{ $photos->currentPage() == $i ? 'is-active' : '' }}">
                                                    {{ $i }}
                                                </a>
                                            @endif

                                            {{-- separator --}}
                                            @if ($i == 2 && $photos->currentPage() - $pageShown > 2)
                                                <span class="button">...</span>
                                            @endif
                                            @if ($i == $photos->currentPage() + $pageShown && $photos->currentPage() + $pageShown < $photos->lastPage())
                                                <span class="button">...</span>
                                            @endif
                                        @endfor
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <small>Page {{ $photos->currentPage() }} of {{ $photos->lastPage() }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('modal')
    <div id="event-modal-delete" class="modal">
        <div class="modal-background jb-modal-close"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Confirm Delete</p>
                <button type="button" class="delete jb-modal-close" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <p>This will permanently delete <b>{{ $event->name }}</b> from your database.</p>
            </section>
            <footer class="modal-card-foot">
                <button type="button" class="button jb-modal-close">Cancel</button>
                <form action="{{ route('admin.event.delete', $event->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button is-danger jb-modal-close">Delete</button>
                </form>
            </footer>
        </div>
        <button type="button" class="modal-close is-large jb-modal-close" aria-label="close"></button>
    </div>
    @if($event->status != 'canceled')
        @if($event->status != 'rejected')
            <div id="event-modal-reject" class="modal">
                <div class="modal-background jb-modal-close"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Confirm Reject</p>
                        <button type="button" class="delete jb-modal-close" aria-label="close"></button>
                    </header>
                    <section class="modal-card-body">
                        <p>Are you sure you want to reject <b>{{ $event->name }}</b>?</p>
                    </section>
                    <footer class="modal-card-foot">
                        <button type="button" class="button jb-modal-close">Cancel</button>
                        <form action="{{ route('admin.event.rejected', $event->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="button is-danger jb-modal-close">Reject</button>
                        </form>
                    </footer>
                </div>
                <button type="button" class="modal-close is-large jb-modal-close" aria-label="close"></button>
            </div>
        @endif

        @if($event->status != 'confirmed')
            <div id="event-modal-confirm" class="modal">
                <div class="modal-background jb-modal-close"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Confirm Event</p>
                        <button type="button" class="delete jb-modal-close" aria-label="close"></button>
                    </header>
                    <section class="modal-card-body">
                        <p>Are you sure you want to confirm <b>{{ $event->name }}</b>?</p>
                    </section>
                    <footer class="modal-card-foot">
                        <button type="button" class="button jb-modal-close">Cancel</button>
                        <form action="{{ route('admin.event.confirmed', $event->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="button is-primary jb-modal-close">Confirm</button>
                        </form>
                    </footer>
                </div>
                <button type="button" class="modal-close is-large jb-modal-close" aria-label="close"></button>
            </div>
        @endif
    @endif
@endsection
