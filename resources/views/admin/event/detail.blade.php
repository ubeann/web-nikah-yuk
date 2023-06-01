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
                                <a href="{{ $event->guest_url }}">{{ $event->guest_url }}</a>
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
@endsection

@section('modal')
    <div id="event-modal-delete" class="modal">
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
    @if($event->status != 'canceled')
        @if($event->status != 'rejected')
            <div id="event-modal-reject" class="modal">
                <div class="modal-background jb-modal-close"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Confirm Reject</p>
                        <button class="delete jb-modal-close" aria-label="close"></button>
                    </header>
                    <section class="modal-card-body">
                        <p>Are you sure you want to reject <b>{{ $event->name }}</b>?</p>
                    </section>
                    <footer class="modal-card-foot">
                        <button class="button jb-modal-close">Cancel</button>
                        <form action="{{ route('admin.event.rejected', $event->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="button is-danger jb-modal-close">Reject</button>
                        </form>
                    </footer>
                </div>
                <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
            </div>
        @endif

        @if($event->status != 'confirmed')
            <div id="event-modal-confirm" class="modal">
                <div class="modal-background jb-modal-close"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Confirm Event</p>
                        <button class="delete jb-modal-close" aria-label="close"></button>
                    </header>
                    <section class="modal-card-body">
                        <p>Are you sure you want to confirm <b>{{ $event->name }}</b>?</p>
                    </section>
                    <footer class="modal-card-foot">
                        <button class="button jb-modal-close">Cancel</button>
                        <form action="{{ route('admin.event.confirmed', $event->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="button is-primary jb-modal-close">Confirm</button>
                        </form>
                    </footer>
                </div>
                <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
            </div>
        @endif
    @endif
@endsection
