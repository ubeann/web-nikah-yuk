<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClientMiddleware {
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next) {
        // Check if user is authenticated
        if (Auth::guard('user')->check()) {
            return $next($request);
        }

        // Create flash alert
        Session::flash('alert', [
            'type' => 'danger',
            'message' => 'Kamu tidak memiliki akses ke halaman tersebut. Silahkan login terlebih dahulu.'
        ]);

        // Redirect to login page
        return redirect()->route('client.login.form');
    }
}
