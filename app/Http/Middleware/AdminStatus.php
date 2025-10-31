<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminStatus
{
    public function handle($request, Closure $next)
    {
        $admin = Auth::guard('admin')->user();

        if ($admin && $admin->status == 0) {
            Auth::guard('admin')->logout();

            return redirect()->route('admin.login')
                ->with('error', 'Your account is deactivated. Please contact the administrator.');
        }

        return $next($request);
    }
}
