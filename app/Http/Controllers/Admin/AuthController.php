<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        // Merge username to lowercase
        $request->merge(['username' => strtolower($request->input('username'))]);

        // Attempt login
        if (auth()->guard('admin')->attempt($request->only('username', 'password'))) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->withErrors(['username' => 'Username or password is incorrect', 'password' => 'Username or password is incorrect']);
        }
    }

    public function updateUsername(Request $request) {
        // Validate request
        $request->validate([
            'username' => 'required|min:3|unique:admins,username,' . auth()->guard('admin')->user()->id,
        ]);

        // Get admin
        $admin = Admin::find(auth()->guard('admin')->user()->id);

        // Update admin
        $admin->username = $request->input('username');
        $admin->save();

        // Redirect back
        return redirect()->back()->with('success', 'Username updated to "' . $request->input('username') . '" successfully');
    }

    public function updatePassword(Request $request) {
        // Validate request
        $request->validate([
            'password_current' => 'required|min:8|max:32',
            'password' => 'required|min:8|max:32',
            'password_confirmation' => 'required|min:8|max:32|same:password',
        ]);

        // Get admin
        $admin = Admin::find(auth()->guard('admin')->user()->id);

        // Check old password
        if (!password_verify($request->input('password_current'), $admin->password)) {
            return redirect()->back()->withErrors(['password_current' => 'Current password is incorrect']);
        }

        // Update admin
        $admin->password = Hash::make($request->input('password'));
        $admin->save();

        // Redirect back
        return redirect()->back()->with('success', 'Password updated successfully');
    }

    public function logout() {
        // Logout
        auth()->guard('admin')->logout();

        // Redirect to login page
        return redirect()->route('admin.login.form');
    }
}
