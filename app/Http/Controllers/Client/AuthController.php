<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller {
    public function login(Request $request) {
        // Check Auth
        if (auth()->guard('user')->check()) {
            return redirect()->route('client.landing');
        }

        // Validate request
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|min:8|max:32',
        ]);

        // Attempt login
        if (auth()->guard('user')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // Return view
            return redirect()->route('client.landing');
        } else {
            return redirect()->back()->withErrors(['email' => 'Email or password is incorrect', 'password' => 'Email or password is incorrect']);
        }
    }

    public function register(Request $request) {
        // Check Auth
        if (auth()->guard('user')->check()) {
            return redirect()->route('client.landing');
        }

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
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users,phone|min:10|max:15',
            'password' => 'required|min:8|max:32',
            'password_confirmation' => 'required|same:password',
        ]);

        // Regex phone number validation (Indonesia only)
        $regex = '/^(\+62|0)8[1-9][0-9]{6,}$/';
        if (!preg_match($regex, $request->phone)) {
            return redirect()->back()->withErrors(['phone' => 'Invalid phone number'])->withInput();
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Create session
        Session::flash('alert', ['type' => 'success', 'message' => 'Selamat ' . $user->name . ', akun anda berhasil dibuat! Silahkan login untuk melanjutkan.']);

        // Redirect to login page
        return redirect()->route('client.login.form');
    }

    public function updateProfile(Request $request) {
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
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email,' . auth()->guard('user')->user()->id,
            'phone' => 'required|unique:users,phone,' . auth()->guard('user')->user()->id . '|min:10|max:15',
        ]);

        // Regex phone number validation (Indonesia only)
        $regex = '/^(\+62|0)8[1-9][0-9]{6,}$/';
        if (!preg_match($regex, $request->phone)) {
            return redirect()->back()->withErrors(['phone' => 'Invalid phone number'])->withInput();
        }

        // Update user
        $user = User::find(auth()->guard('user')->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        // Create session
        Session::flash('alert', ['type' => 'success', 'message' => 'Profile anda berhasil diperbarui!']);

        // Redirect to profile page
        return redirect()->route('client.profile.form');
    }

    public function updatePassword(Request $request) {
        // Validate request
        $request->validate([
            'current_password' => 'required|min:8|max:32'
        ]);

        // Check current password
        if (!Hash::check($request->current_password, auth()->guard('user')->user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        // Validate request
        $request->validate([
            'password' => 'required|min:8|max:32',
            'password_confirmation' => 'required|same:password',
        ]);

        // Update user
        $user = User::find(auth()->guard('user')->user()->id);
        $user->password = Hash::make($request->password);
        $user->save();

        // Create session
        Session::flash('alert', ['type' => 'success', 'message' => 'Password anda berhasil diperbarui!']);

        // Redirect to profile page
        return redirect()->route('client.profile.form');
    }

    public function logout() {
        // Logout
        auth()->guard('user')->logout();

        // Redirect to login page
        return redirect()->route('client.login.form');
    }
}
