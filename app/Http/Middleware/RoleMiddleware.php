<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Usage in routes:
     *  ->middleware('role:1,2')                // by role_id
     *  ->middleware('role:admin,superadmin')   // by role name
     *  ->middleware('role:1,admin')            // mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->guest(route('login'));
        }

        // Normalize roles: flatten comma-separated params (in case middleware called as 'role:1,2' Laravel already splits,
        // but if you passed a single parameter with comma, explode anyway).
        $expanded = [];
        foreach ($roles as $r) {
            if (is_string($r) && strpos($r, ',') !== false) {
                foreach (explode(',', $r) as $x) {
                    $x = trim($x);
                    if ($x !== '') $expanded[] = $x;
                }
            } elseif ($r !== '') {
                $expanded[] = $r;
            }
        }

        // If still empty, default deny
        if (empty($expanded)) {
            abort(403, 'Access denied (no roles configured).');
        }

        // Ensure role relation is loaded to allow name checks without extra queries
        if (! $user->relationLoaded('role')) {
            try {
                $user->loadMissing('role');
            } catch (\Throwable $e) {
                // ignore if role relation not defined; will still work with role_id checks
            }
        }

        // Check each allowed role: support numeric (role_id) or name (role.name)
        foreach ($expanded as $allowed) {
            // numeric check (role_id)
            if (is_numeric($allowed) && intval($user->role_id) === intval($allowed)) {
                return $next($request);
            }

            // name check (case-insensitive)
            if (! is_numeric($allowed) && $user->role && strcasecmp($user->role->name, $allowed) === 0) {
                return $next($request);
            }
        }

        // If no match: deny. You can change to redirect back with message if preferred.
        abort(403, 'Access denied');
    }
}
