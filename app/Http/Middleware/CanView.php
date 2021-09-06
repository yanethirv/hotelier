<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $permission)
    {
        
        if (canView($permission)) {
            return $next($request);
        }
        
        abort(403, 'No tiene permiso');
    }
}
