<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;

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

    public function editForm($id) {
        $guest = Guest::findOrFail($id);
        return view('admin.guest.edit', compact('guest'));
    }

    public function edit(Request $request, $id) {
        $guest = Guest::findOrFail($id);

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

        $request->merge([
            'phone' => $phone,
        ]);

        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|min:10|max:15',
            'address' => 'required|string'
        ]);

        $regex = '/^(\+62|0)8[1-9][0-9]{6,}$/';
        if (!preg_match($regex, $request->phone)) {
            return redirect()->back()->withErrors(['phone' => 'Invalid phone number'])->withInput();
        }

        $guest->name = $request->name;
        $guest->phone = $request->phone;
        $guest->address = $request->address;
        $guest->save();

        return redirect()->route('admin.guest.index')->with('success', 'Guest ' . $guest->name . ' updated successfully');
    }

    public function delete($id) {
        $guest = Guest::findOrFail($id);
        $guest->delete();
        return redirect()->route('admin.guest.index')->with('success', 'Guest ' . $guest->name . ' deleted successfully');
    }
}
