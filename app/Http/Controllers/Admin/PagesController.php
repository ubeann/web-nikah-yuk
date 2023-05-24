<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
}
