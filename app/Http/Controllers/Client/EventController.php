<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller {
    public function index() {
        // Get user
        $user = User::find(auth()->guard('user')->id());

        // Get events
        $events = $user->events()->orderBy('created_at', 'desc')->get();

        // Return view
        return view('client.event.index', compact('events'));
    }
}
