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
        else
            $event->price = null;
        $event->save();

        // Return view
        return redirect()->route('client.event.index')->with('alert', ['type' => 'success', 'message' => 'Event ' . $event->name . ' berhasil dibuat.']);
    }

    public function detail($id) {
        // Get event
        $event = Event::find($id);

        // Return view
        return view('client.event.detail', compact('event'));
    }

    public function editForm($id) {
        // Get event
        $event = Event::find($id);

        // Check if event is pending
        if ($event->status != 'pending')
            return redirect()->route('client.event.index')->with('alert', ['type' => 'danger', 'message' => 'Event ' . $event->name . ' tidak dapat diubah.']);

        // Return view
        return view('client.event.edit', compact('event'));
    }

    public function edit(Request $request, $id) {
        // Get event
        $event = Event::find($id);

        // Check if event is pending
        if ($event->status != 'pending')
            return redirect()->route('client.event.index')->with('alert', ['type' => 'danger', 'message' => 'Event ' . $event->name . ' tidak dapat diubah.']);

        // Validate request
        $request->validate([
            'name' => 'required|string',
            'service' => 'required|string|in:kilat,xpress,honeymoon,custom',
            'date' => 'required|date|after:today',
            'location' => 'required|string',
            'description' => 'nullable|string',
        ]);

        // Update event
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
        else
            $event->price = null;
        $event->save();

        // Return view
        return redirect()->route('client.event.index')->with('alert', ['type' => 'success', 'message' => 'Event ' . $event->name . ' berhasil diubah.']);
    }

    public function delete($id) {
        // Get event
        $event = Event::find($id);

        // Check if event is pending
        if ($event->status != 'pending')
            return redirect()->route('client.event.index')->with('alert', ['type' => 'danger', 'message' => 'Event ' . $event->name . ' tidak dapat dibatalkan.']);

        // Delete event
        $event->status = 'canceled';
        $event->save();

        // Return view
        return redirect()->route('client.event.index')->with('alert', ['type' => 'success', 'message' => 'Event ' . $event->name . ' berhasil dibatalkan.']);
    }
}
