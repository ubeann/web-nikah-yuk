<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Guest;
use App\Models\User;

class PagesController extends Controller {
    public function dashboard() {
        // Get all users (as clients) with pagination
        $clients = User::orderBy('created_at', 'desc')->paginate(10);

        // Get all events with pagination
        $events = Event::orderBy('created_at', 'desc')->paginate(10);

        // Get all guests with pagination
        $guests = Guest::orderBy('created_at', 'desc')->paginate(10);

        // Card data
        $card = [
            'client' => User::count(),
            'event' => Event::count(),
            'guest' => Guest::count()
        ];

        // Return view
        return view('admin.dashboard', compact('clients', 'events', 'guests', 'card'));
    }

    public function settings() {
        // Return view
        return view('admin.settings');
    }
}
