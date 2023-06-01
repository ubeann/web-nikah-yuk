<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;

class GuestController extends Controller {
    public function index() {
        $guests = Guest::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.guest.index', compact('guests'));
    }

    public function detail($id) {
        $guest = Guest::findOrFail($id);
        $event = $guest->event;
        return view('admin.guest.detail', compact('guest', 'event'));
    }

    public function delete($id) {
        $guest = Guest::findOrFail($id);
        $guest->delete();
        return redirect()->route('admin.guest.index')->with('success', 'Guest ' . $guest->name . ' deleted successfully');
    }
}
