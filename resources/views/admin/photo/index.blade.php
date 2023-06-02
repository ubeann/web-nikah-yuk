@extends('layouts.admin-dashboard')

@section('title', 'Photo')

@section('title-button')
    <button type="button" class="button is-primary jb-modal" data-target="photo-modal-add">
        <span class="icon"><i class="mdi mdi-plus"></i></span>
        <span>Add Photo</span>
    </button>
@endsection

@section('navigation')
    <li>Photo</li>
@endsection

@section('content')
    <div class="columns is-multiline">
        @forelse ($photos as $photo)
            <div class="column is-4">
                <div class="card">
                    <div class="card-image">
                      <figure class="image is-4by3 is-cover">
                        <img src="{{ asset($photo->url) }}" alt="{{ $photo->filename }}" style="object-fit: cover; object-position: center; width: 100%; height: 100%;">
                      </figure>
                    </div>
                    <div class="card-content is-overlay">
                       <a href={{ route('admin.event.detail', $photo->event->id) }} class="tag is-primary">{{ $photo->event->name }}</a>
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
        @empty
            <div class="column is-12">
                <div class="notification is-warning">
                    No photos found.
                </div>
            </div>
        @endforelse

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
    </div>
@endsection

@section('modal')
    <form action="{{ route('admin.photo.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="photo-modal-add" class="modal">
            <div class="modal-background jb-modal-close"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Add Photo</p>
                    <button type="button" class="delete jb-modal-close" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <div class="field">
                        <label class="label">Event</label>
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="event_id">
                                    <option value="" selected disabled>Select Event</option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}">{{ $event->name }} ({{'@' . $event->user->name }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if($errors->has('event_id'))
                            <p class="help is-danger">{{ $errors->first('event_id') }}</p>
                        @else
                            <p class="help">Required. Event to be associated with the photo(s).</p>
                        @endif
                    </div>
                    <div class="field">
                        <label class="label">Photo</label>
                        <div class="file has-name is-fullwidth is-primary">
                            <label class="file-label">
                                <input type="file" class="file-input" name="photos[]" accept="image/*" onchange="displaySelectedFiles(event)" multiple>
                                <span class="file-cta">
                                    <span class="icon"><i class="mdi mdi-upload default"></i></span>
                                    <span>Pick a file</span>
                                </span>
                                <span id="selectedFilesContainer" class="file-name">No file uploaded</span>
                            </label>
                        </div>
                        @if($errors->has('photos'))
                            <p class="help is-danger">{{ $errors->first('photos') }}</p>
                        @else
                            <p class="help">Required. Photo(s) to be uploaded.</p>
                        @endif
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button type="button" class="button jb-modal-close">Cancel</button>
                    <button type="submit" class="button is-primary jb-modal-close">Upload</button>
                </footer>
            </div>
            <button type="button" class="modal-close is-large jb-modal-close" aria-label="close"></button>
        </div>
    </form>

    @foreach ($photos as $photo)
        <div id="photo-modal-{{ $photo->id }}" class="modal">
            <div class="modal-background jb-modal-close"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Confirm Delete</p>
                    <button type="button" class="delete jb-modal-close" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <p>This will permanently delete <b>{{ $photo->filename }}</b> from your database.</p>
                </section>
                <footer class="modal-card-foot">
                    <button type="button" class="button jb-modal-close">Cancel</button>
                    <form action="{{ route('admin.photo.delete', $photo->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button is-danger jb-modal-close">Delete</button>
                    </form>
                </footer>
            </div>
            <button type="button" class="modal-close is-large jb-modal-close" aria-label="close"></button>
        </div>
    @endforeach
@endsection

@section('js')
    <script>
        function displaySelectedFiles(event) {
            const files = event.target.files;
            const container = document.getElementById("selectedFilesContainer");
            container.innerHTML = "";

            if (files.length === 0) {
                container.textContent = "No file uploaded";
            } else if (files.length === 1) {
                const file = files[0];
                const fileName = file.name;
                const fileSize = (file.size / 1024).toFixed(2); // Convert to KB
                container.textContent = fileName + " (" + fileSize + " KB)";
            } else {
                const totalSize = [...files].reduce((total, file) => total + (file.size/1024), 0).toFixed(2);
                container.textContent = files.length + " files selected (" + totalSize + " KB)";
            }
        }
    </script>
@endsection
