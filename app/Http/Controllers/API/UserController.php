<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

    public function store(Request $request) {
        // Check if form data is provided
        if (!$request->hasAny(['name', 'email', 'phone', 'password'])) {
            return response()->json([
                'status' => 'error',
                'code' => 422,
                'message' => 'Missing form data',
                'errors' => [
                    'form_data' => [
                        'Please provide the required form data.',
                    ],
                ],
                'timestamp' => date('Y-m-d H:i:s'),
            ], 422);
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
        try {
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|unique:users,email',
                'phone' => 'required|unique:users,phone|min:10|max:15',
                'password' => 'required|min:8|max:32',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'code' => 422,
                'message' => 'Invalid form data',
                'errors' => $e->errors(),
                'timestamp' => date('Y-m-d H:i:s'),
            ], 422);
        }

        // Create user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => strtolower($request->input('email')),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Return response
        return response()->json([
            'status' => 'success',
            'code' => 201,
            'message' => 'User created successfully',
            'data' => $user,
            'timestamp' => date('Y-m-d H:i:s'),
        ], 201);
    }

    public function update(Request $request, $id) {
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

        // Check if form data is provided
        if (!$request->hasAny(['name', 'email', 'phone', 'password'])) {
            return response()->json([
                'status' => 'error',
                'code' => 422,
                'message' => 'Missing form data',
                'errors' => [
                    'form_data' => [
                        'Please provide the required form data.',
                    ],
                ],
                'timestamp' => date('Y-m-d H:i:s'),
            ], 422);
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
        try {
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|unique:users,email,'.$id,
                'phone' => 'required|unique:users,phone,'.$id.'|min:10|max:15',
                'password' => 'min:8|max:32',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'code' => 422,
                'message' => 'Invalid form data',
                'errors' => $e->errors(),
                'timestamp' => date('Y-m-d H:i:s'),
            ], 422);
        }

        // Update user
        $user->update([
            'name' => $request->input('name'),
            'email' => strtolower($request->input('email')),
            'phone' => $request->input('phone'),
        ]);

        // Check password
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->input('password')),
            ]);
        }

        // Return response
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'User updated successfully',
            'data' => $user,
            'timestamp' => date('Y-m-d H:i:s'),
        ], 200);
    }
}
