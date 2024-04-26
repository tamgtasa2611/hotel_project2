<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CheckAdminLevel
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $admin = session('admin');
        $adminLevel = $admin->level;
        if ($adminLevel == 0) {
            return $next($request);
        } else {
            return Redirect::route('admin.bookings')->with('permission_fail', "You don't have enough permission to view this!");
        }
    }
}
