<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ExperimentalController extends Controller {
    public function listUser() {
        // Get all users
        $users = User::all();

        // Return view
        return view('list-user', compact('users'));
    }

    public function editUser($id) {
        // Get user
        $user = User::find($id);

        // Return view
        return view('edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id) {
        // Get user
        $user = User::find($id);

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
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|min:10|max:15|unique:users,phone,' . $user->id,
            'password' => 'nullable|min:8|max:32',
        ]);

        // Update user
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = $request->filled('password') ? Hash::make($request->input('password')) : $user->password;
        $user->save();

        // Return view
        return redirect()->route('user.list');
    }

    public function deleteUser($id) {
        // Get user
        $user = User::find($id);

        // Delete user
        $user->delete();

        // Return view
        return redirect()->route('user.list');
    }
}
