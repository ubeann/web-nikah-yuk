<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller {
    public function loginForm() {
        // Check Auth
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        // Return view
        return view('admin.login');
    }

    public function login(Request $request) {
        // Check Auth
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        // Validate request
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:8|max:32',
        ]);

        // Attempt login
        if (auth()->guard('admin')->attempt($request->only('username', 'password'))) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->withErrors(['username' => 'Username or password is incorrect', 'password' => 'Username or password is incorrect']);
        }
    }

    public function logout() {
        // Logout
        auth()->guard('admin')->logout();

        // Redirect to login page
        return redirect()->route('admin.login.form');
    }
}
