@extends('layouts.admin-dashboard')

@section('title', 'Edit ' . $event->name)

@section('navigation')
    <li>Event</li>
    <li>Edit {{ $event->name }}</li>
@endsection

@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-calendar-edit default"></i></span>
                Edit Event
            </p>
        </header>
        <div class="card-content">
            <form action="{{ route('admin.event.edit.submit', $event->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Name</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input type="text" name="name" value="{{ old('name') ?? $event->name }}"
                                    class="input {{ $errors->has('name') ? 'is-danger' : '' }}">
                            </div>
                            @if($errors->has('name'))
                                <p class="help is-danger">{{ $errors->first('name') }}</p>
                            @else
                                <p class="help">Required. Event name</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Service</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <div class="select {{ $errors->has('service') ? 'is-danger' : '' }}">
                                    <select name="service">
                                        <option value="" disabled selected>Choose Service</option>
                                        <option value="kilat" @if((old('service') ?? $event->service) == 'kilat') selected @endif>Kilat (Rp. 8.000.000)</option>
                                        <option value="xpress" @if((old('service') ?? $event->service) == 'xpress') selected @endif>Xpress (Rp. 12.000.000)</option>
                                        <option value="honeymoon" @if((old('service') ?? $event->service) == 'honeymoon') selected @endif>Honeymoon (Rp. 18.000.000)</option>
                                        <option value="custom" @if((old('service') ?? $event->service) == 'custom') selected @endif>Custom (Tarif Menyesuaikan)</option>
                                    </select>
                                </div>
                            </div>
                            @if($errors->has('service'))
                                <p class="help is-danger">{{ $errors->first('service') }}</p>
                            @else
                                <p class="help">Required. Event service</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Date</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input type="date" name="date" min="{{ date('Y-m-d') }}"
                                    value="{{ old('date') ?? date('Y-m-d', strtotime($event->date)) }}"
                                    class="input {{ $errors->has('date') ? 'is-danger' : '' }}">
                            </div>
                            @if($errors->has('date'))
                                <p class="help is-danger">{{ $errors->first('date') }}</p>
                            @else
                                <p class="help">Required. Event date</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Location</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input type="text" name="location" value="{{ old('location') ?? $event->location }}"
                                    class="input {{ $errors->has('location') ? 'is-danger' : '' }}">
                            </div>
                            @if($errors->has('location'))
                                <p class="help is-danger">{{ $errors->first('location') }}</p>
                            @else
                                <p class="help">Required. Event location</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Description</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="description" class="textarea">{{ old('description') ?? $event->description }}</textarea>
                            </div>
                            @if($errors->has('description'))
                                <p class="help is-danger">{{ $errors->first('description') }}</p>
                            @else
                                <p class="help">Event description</p>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <button type="button" class="button is-primary jb-modal" data-target="edit-event-modal">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Change Event Modal -->
                <div id="edit-event-modal" class="modal jb-modal">
                    <div class="modal-background jb-modal-close"></div>
                    <div class="modal-card">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Confirm Changes to Event</p>
                            <button type="button" class="delete jb-modal-close" aria-label="close"></button>
                        </header>
                        <section class="modal-card-body">
                            <p>Are you sure you want to save changes to this event?</p>
                        </section>
                        <footer class="modal-card-foot">
                            <button type="button" class="button jb-modal-close">Cancel</button>
                            <button type="submit" class="button is-primary">Save</button>
                        </footer>
                    </div>
                    <button type="button" class="modal-close is-large jb-modal-close" aria-label="close"></button>
                </div>
            </form>
        </div>
    </div>
@endsection
