@extends('layouts.admin-dashboard')

@section('title', 'Settings')

@section('navigation')
<li>Settings</li>
@endsection

@section('content')
    <!-- Change Username -->
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-account default"></i></span>
                Change Username
            </p>
        </header>
        <div class="card-content">
            <form action="{{ route('admin.settings.update.username') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Username</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input type="text" name="username" value="{{ old('username') ?? auth('admin')->user()->username }}"
                                    class="input {{ $errors->has('username') ? 'is-danger' : '' }}">
                            </div>
                            @if($errors->has('username'))
                                <p class="help is-danger">{{ $errors->first('username') }}</p>
                            @else
                                <p class="help">Required. Your username</p>
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
                                <button type="button" class="button is-primary jb-modal" data-target="change-username-modal">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Change Username Modal -->
                <div id="change-username-modal" class="modal jb-modal">
                    <div class="modal-background jb-modal-close"></div>
                    <div class="modal-card">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Confirm Change Username</p>
                            <button class="delete jb-modal-close" aria-label="close"></button>
                        </header>
                        <section class="modal-card-body">
                            <p>Are you sure you want to change your username?</p>
                        </section>
                        <footer class="modal-card-foot">
                            <button class="button jb-modal-close">Cancel</button>
                            <button type="submit" class="button is-primary">Change Username</button>
                        </footer>
                    </div>
                    <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Change Password -->
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-lock default"></i></span>
                Change Password
            </p>
        </header>
        <div class="card-content">
            <form action="{{ route('admin.settings.update.password') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Current password</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input type="password" name="password_current" autocomplete="current-password"
                                    class="input {{ $errors->has('password_current') ? 'is-danger' : '' }}">
                            </div>
                            @if($errors->has('password_current'))
                                <p class="help is-danger">{{ $errors->first('password_current') }}</p>
                            @else
                                <p class="help">Required. Your current password</p>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">New password</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input type="password" autocomplete="new-password" name="password"
                                    class="input {{ $errors->has('password') ? 'is-danger' : '' }}">
                            </div>
                            @if($errors->has('password'))
                                <p class="help is-danger">{{ $errors->first('password') }}</p>
                            @else
                                <p class="help">Required. New password</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Confirm password</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input type="password" autocomplete="new-password" name="password_confirmation"
                                    class="input {{ $errors->has('password_confirmation') ? 'is-danger' : '' }}">
                            </div>
                            @if($errors->has('password_confirmation'))
                                <p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
                            @else
                                <p class="help">Required. New password one more time</p>
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
                                <button type="button" class="button is-primary jb-modal" data-target="change-password-modal">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Change Password Modal -->
                <div id="change-password-modal" class="modal">
                    <div class="modal-background jb-modal-close"></div>
                    <div class="modal-card">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Confirm Change Password</p>
                            <button class="delete jb-modal-close" aria-label="close"></button>
                        </header>
                        <section class="modal-card-body">
                            <p>Are you sure you want to change your password?</p>
                        </section>
                        <footer class="modal-card-foot">
                            <button class="button jb-modal-close">Cancel</button>
                            <button type="submit" class="button is-primary">Change Password</button>
                        </footer>
                    </div>
                    <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
                </div>
            </form>
        </div>
    </div>
@endsection
