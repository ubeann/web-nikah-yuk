<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller {
    public function index() {
        // Get users
        $users = User::all();

        // Return response
        return response()->json([
            'status' => 'success',
            'data' => $users,
        ], 200);
    }

    public function show($id) {
        // Get user
        $user = User::find($id);

        // Check user
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }

        // Return response
        return response()->json([
            'status' => 'success',
            'data' => $user,
        ], 200);
    }
}
