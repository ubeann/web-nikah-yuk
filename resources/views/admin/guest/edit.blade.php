@extends('layouts.admin-dashboard')

@section('title', 'Edit ' . $guest->name)

@section('navigation')
    <li>Guest</li>
    <li>Edit {{ $guest->name }}</li>
@endsection

@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-book"></i></span>
                Edit Guest
            </p>
        </header>
        <div class="card-content">
            <form action="{{ route('admin.guest.edit.submit', $guest->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Name</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input type="text" name="name" value="{{ old('name') ?? $guest->name }}"
                                    class="input {{ $errors->has('name') ? 'is-danger' : '' }}">
                            </div>
                            @if($errors->has('name'))
                                <p class="help is-danger">{{ $errors->first('name') }}</p>
                            @else
                                <p class="help">Required. Guest's full name.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Phone</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input type="tel" name="phone" value="{{ old('phone') ?? $guest->phone }}"
                                    class="input {{ $errors->has('phone') ? 'is-danger' : '' }}">
                            </div>
                            @if($errors->has('phone'))
                                <p class="help is-danger">{{ $errors->first('phone') }}</p>
                            @else
                                <p class="help">Required. Guest's phone number.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Address</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="address"
                                    class="textarea {{ $errors->has('address') ? 'is-danger' : '' }}">{{ old('address') ?? $guest->address }}</textarea>
                            </div>
                            @if($errors->has('address'))
                                <p class="help is-danger">{{ $errors->first('address') }}</p>
                            @else
                                <p class="help">Required. Guest's address.</p>
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
                                <button type="button" class="button is-primary jb-modal" data-target="edit-guest-modal">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Change Guest Modal -->
                <div id="edit-guest-modal" class="modal jb-modal">
                    <div class="modal-background jb-modal-close"></div>
                    <div class="modal-card">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Confirm Changes to Guest</p>
                            <button type="button" class="delete jb-modal-close" aria-label="close"></button>
                        </header>
                        <section class="modal-card-body">
                            <p>Are you sure you want to save changes to this guest?</p>
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
