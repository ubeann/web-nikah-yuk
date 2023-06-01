<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller {
    public function form($id) {
        // Get event
        $event = Event::where('guest_url', $id)->first();

        // Return view
        return view('client.guest.registration', compact('event'));
    }

    public function submit(Request $request, $id) {
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

    public function greet($id) {
        // Get event
        $event = Event::where('guest_url', $id)->first();

        // Return view
        return view('client.guest.greet', compact('event'));
    }
}
