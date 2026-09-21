<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionMiddleware
{
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        foreach ($permissions as $permission) {
            if (Gate::allows('has-permission', $permission)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');
    }
}
