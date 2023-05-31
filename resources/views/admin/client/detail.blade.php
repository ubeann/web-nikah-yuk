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
@endsection
