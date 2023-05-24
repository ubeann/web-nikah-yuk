<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class PagesController extends Controller {
    public function dashboard() {
        // Get all users (as clients) with pagination
        $clients = User::orderBy('created_at', 'desc')->paginate(10);

        // Card data
        $card = [
            'client' => User::count(),
        ];

        // Return view
        return view('admin.dashboard', compact('clients', 'card'));
    }

    public function settings() {
        // Return view
        return view('admin.settings');
    }
}
