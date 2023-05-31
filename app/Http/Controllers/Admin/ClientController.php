<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller {
    public function index() {
        // Get clients
        $clients = User::orderBy('name', 'asc')->paginate(10);

        // Return view
        return view('admin.client.index', compact('clients'));
    }

    public function detail($id) {
        // Get client
        $client = User::findOrFail($id);

        // Return view
        return view('admin.client.detail', compact('client'));
    }

    public function edit($id) {
        // Get client
        $client = User::findOrFail($id);

        // Return view
        return view('admin.client.edit', compact('client'));
    }

    public function updateProfile(Request $request, $id) {
        // Get client
        $client = User::findOrFail($id);

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
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $client->id,
            'phone' => 'required|string|min:10|max:15|unique:users,phone,' . $client->id,
        ]);

        // Regex phone number validation (Indonesia only)
        $regex = '/^(\+62|0)8[1-9][0-9]{6,}$/';
        if (!preg_match($regex, $request->phone)) {
            return redirect()->back()->withErrors(['phone' => 'Invalid phone number'])->withInput();
        }

        // Update client
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->save();

        // Return view
        return redirect()->route('admin.client.index')->with('success', 'Client "' . $client->name . '" updated successfully.');
    }

    public function updatePassword(Request $request, $id) {
        // Get client
        $client = User::findOrFail($id);

        // Validate request
        $request->validate([
            'password' => 'required|min:8|max:32',
            'password_confirmation' => 'required|same:password',
        ]);

        // Update client
        $client->password = Hash::make($request->password);
        $client->save();

        // Return view
        return redirect()->route('admin.client.index')->with('success', 'Client "' . $client->name . '" changed password successfully.');
    }

    public function delete($id) {
        // Get client
        $client = User::findOrFail($id);

        // TODO: Delete client's related data

        // Get client name
        $clientName = $client->name;

        // Delete client
        $client->delete();

        // Return view
        return redirect()->route('admin.client.index')->with('success', 'Client ' . $clientName . ' deleted successfully.');
    }
}
