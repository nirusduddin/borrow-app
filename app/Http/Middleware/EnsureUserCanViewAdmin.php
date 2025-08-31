<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserCanViewAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // ปล่อยให้ guest ไปเจอ auth middleware ของ Filament เอง
        if ($user && ! $user->can('view admin')) {
            abort(403, 'You do not have permission to view the admin panel.');
        }

        return $next($request);
    }
}