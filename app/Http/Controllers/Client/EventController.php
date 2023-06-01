<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Guest;
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

        // Get guests
        $guests = $event->guests()->orderBy('created_at', 'desc')->get();

        // Return view
        return view('client.event.detail', compact('event', 'guests'));
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

    public function guestForm($id) {
        // Get event
        $event = Event::where('guest_url', $id)->first();

        // Return view
        return view('client.guest.registration', compact('event'));
    }

    public function guestSubmit(Request $request, $id) {
        // Get event
        $event = Event::where('guest_url', $id)->first();

        // Check event is exist
        if (!$event)
            return redirect()->route('client.guest.greet', ['id' => $id])->with('alert', ['type' => 'danger', 'message' => 'Event tidak ditemukan.']);

        // Check phone number
        $phone = str_replace(" ","",$request->input('phone'));
        $phone = str_replace("(","",$phone);
        $phone = str_replace(")","",$phone);
        $phone = str_replace(".","",$phone);
        $phone = str_replace("-","",$phone);
        if(!preg_match('/[^+0-9]/',trim($phone))){
            if(substr(trim($phone), 0, 3) == '+62'){
                $phone = trim($phone);
            }
            elseif(substr(trim($phone), 0, 1) == '0'){
                $phone = '+62'.substr(trim($phone), 1);
            }
        }

        // Merge request input
        $request->merge([
            'phone' => $phone,
        ]);

        // Validate request
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|min:10|max:15',
            'address' => 'required|string'
        ]);

        // Regex phone number validation (Indonesia only)
        $regex = '/^(\+62|0)8[1-9][0-9]{6,}$/';
        if (!preg_match($regex, $request->phone)) {
            return redirect()->back()->withErrors(['phone' => 'Invalid phone number'])->withInput();
        }

        // Create guest
        $guest = new Guest();
        $guest->event_id = $event->id;
        $guest->name = $request->name;
        $guest->phone = $request->phone;
        $guest->address = $request->address;
        $guest->save();

        // Return view
        return redirect()->route('client.guest.greet', ['id' => $event->guest_url])->with('alert', ['type' => 'success', 'message' => 'Registrasi atas nama ' . $guest->name . ' berhasil.']);
    }

    public function guestGreet($id) {
        // Get event
        $event = Event::where('guest_url', $id)->first();

        // Return view
        return view('client.guest.greet', compact('event'));
    }
}
