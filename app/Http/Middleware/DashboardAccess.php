<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DashboardAccess
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
        if ($request->user()->role == 'admin' || $request->user()->role == 'employee') {
            return $next($request);
        } else {
            return abort(404, 'Bạn không quyền để truy cập trang này');
        }
    }
}
