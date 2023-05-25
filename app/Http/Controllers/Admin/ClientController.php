<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller {
    public function index() {
        // Get clients
        $clients = User::orderBy('name', 'asc')->paginate(10);

        // Return view
        return view('admin.client.index', compact('clients'));
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
