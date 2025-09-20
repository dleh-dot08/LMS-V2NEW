<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!$user) {
            return redirect('/login');
        }

        // roles dikirim berupa array angka, contoh: role:0,1
        if (!in_array($user->role_id, $roles)) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
