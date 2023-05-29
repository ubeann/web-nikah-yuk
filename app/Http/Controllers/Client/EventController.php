<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller {
    public function index() {
        // Get user
        $user = User::find(auth()->guard('user')->id());

        // Get events
        $events = $user->events()->orderBy('date', 'desc')->get();

        // Return view
        return view('client.event.index', compact('events'));
    }

    public function createForm() {
        // Return view
        return view('client.event.create');
    }

    public function create(Request $request) {
        // Validate request
        $request->validate([
            'name' => 'required|string',
            'service' => 'required|string|in:kilat,xpress,honeymoon,custom',
            'date' => 'required|date|after:today',
            'location' => 'required|string',
            'description' => 'nullable|string',
        ]);

        // Get user
        $user = User::find(auth()->guard('user')->id());

        // Create event
        $event = new Event();
        $event->user_id = $user->id;
        $event->name = $request->name;
        $event->service = $request->service;
        $event->date = $request->date;
        $event->location = $request->location;
        $event->description = $request->description;
        if ($request->service == 'kilat')
            $event->price = 8000000;
        else if ($request->service == 'xpress')
            $event->price = 12000000;
        else if ($request->service == 'honeymoon')
            $event->price = 18000000;
        $event->save();

        // Return view
        return redirect()->route('client.event.index')->with('success', 'Event ' . $event->name . ' berhasil dibuat.');
    }
}
