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
            'code' => 200,
            'message' => 'Users retrieved successfully',
            'data' => $users,
            'timestamp' => date('Y-m-d H:i:s'),
        ], 200);
    }

    public function show($id) {
        // Get user
        $user = User::find($id);

        // Check user
        if (!$user) {
            // Get stack trace
            $stackTrace = debug_backtrace();

            // Return response
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'User not found',
                'errors' => [
                    'user' => [
                        'User not found',
                    ],
                ],
                'stacktrace' => $stackTrace,
                'timestamp' => date('Y-m-d H:i:s'),
            ], 404);
        }

        // Return response
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'User retrieved successfully',
            'data' => $user,
            'timestamp' => date('Y-m-d H:i:s'),
        ], 200);
    }
}
