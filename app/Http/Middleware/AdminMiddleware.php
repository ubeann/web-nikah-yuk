<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminMiddleware {
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next) {
        // Check if user is authenticated
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        // Create flash alert
        Session::flash('alert', [
            'type' => 'danger',
            'message' => 'Kamu tidak memiliki akses ke halaman tersebut. Silahkan login terlebih dahulu.'
        ]);

        // Redirect to login page
        // return redirect()->route('admin.login.form');
        return redirect()->route('client.login.form');  // Merge login portal
    }
}
