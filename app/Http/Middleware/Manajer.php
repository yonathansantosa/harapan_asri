<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Perawat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2])) {
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
