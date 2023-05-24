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
                                <input type="text" name="username" value="{{ old('username') ?? auth('admin')->user()->username }}" required
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
                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
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
                                <input type="password" name="password_current" autocomplete="current-password" required
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
                                <input type="password" autocomplete="new-password" name="password" required
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
                                <input type="password" autocomplete="new-password" name="password_confirmation" required
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
                                <button type="submit" class="button is-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
