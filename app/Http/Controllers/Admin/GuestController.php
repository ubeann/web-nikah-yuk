<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;

class GuestController extends Controller {
    public function index() {
        $guests = Guest::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.guest.index', compact('guests'));
    }
}
