<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Authenticate extends Middleware {
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string {
        // Create flash alert
        Session::flash('alert', [
            'type' => 'danger',
            'message' => 'Kamu tidak memiliki akses ke halaman tersebut. Silahkan login terlebih dahulu.'
        ]);

        // Check if request expects JSON
        return $request->expectsJson() ? null : route('client.login.form');
    }
}
