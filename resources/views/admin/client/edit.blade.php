@extends('layouts.admin-dashboard')

@section('title', 'Edit ' . $client->name)

@section('navigation')
    <li>Client</li>
    <li>Edit {{ $client->name }}</li>
@endsection

@section('content')
    <!-- Edit Profile -->
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-account default"></i></span>
                Edit Profile
            </p>
        </header>
        <div class="card-content">
            <form action="{{ route('admin.client.update.profile', $client->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Name</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input type="text" name="name" value="{{ old('name') ?? $client->name }}" required
                                    class="input {{ $errors->has('name') ? 'is-danger' : '' }}">
                            </div>
                            @if($errors->has('name'))
                                <p class="help is-danger">{{ $errors->first('name') }}</p>
                            @else
                                <p class="help">Required. Client name</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Email</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input type="email" name="email" value="{{ old('email') ?? $client->email }}" required
                                    class="input {{ $errors->has('email') ? 'is-danger' : '' }}">
                            </div>
                            @if($errors->has('email'))
                                <p class="help is-danger">{{ $errors->first('email') }}</p>
                            @else
                                <p class="help">Required. Client email</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Phone Numer</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input type="text" name="phone" value="{{ old('phone') ?? $client->phone }}" required
                                    class="input {{ $errors->has('phone') ? 'is-danger' : '' }}">
                            </div>
                            @if($errors->has('phone'))
                                <p class="help is-danger">{{ $errors->first('phone') }}</p>
                            @else
                                <p class="help">Required. Client phone number</p>
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
            <form action="{{ route('admin.client.update.password', $client->id) }}" method="POST">
                @csrf
                @method('PATCH')
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
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('modal')
@endsection
