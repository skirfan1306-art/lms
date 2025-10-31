<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::guard('admin')->user();

        if (!$user || $user->role !== $role) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
