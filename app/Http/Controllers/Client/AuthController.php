<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller {
    public function checkLogin() {
        // Create data
        $data = [
            'name' => Auth::check() ? Auth::user()->name : 'Guest',
            'email' => Auth::check() ? Auth::user()->email : 'null',
            'isLogin' => Auth::check() ? 'true' : 'false',
        ];

        // Return view
        return view('dummy', compact('data'));
    }

    public function login(Request $request) {
        // TODO: Change route to dashboard if user already logged in
        // Check Auth
        if (Auth::check()) {
            return redirect()->route('client.dummy');
        }

        // Validate request
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|min:8|max:32',
        ]);

        // Attempt login
        Auth::attempt($request->only('email', 'password'), $request->filled('remember'));

        // Check login
        if (Auth::check()) {
            // TODO: Change route to dashboard if user already logged in
            // Return view
            return redirect()->route('client.dummy');
        } else {
            return redirect()->back()->withErrors(['email' => 'Email or password is incorrect', 'password' => 'Email or password is incorrect']);
        }
    }

    public function register(Request $request) {
        // TODO: Change route to dashboard if user already logged in
        // Check Auth
        if (Auth::check()) {
            return redirect()->route('client.dummy');
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

    public function logout() {
        // Logout
        auth()->logout();

        // Redirect to login page
        return redirect()->route('client.login.form');
    }
}