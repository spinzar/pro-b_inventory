<?php
// app/Http/Middleware/CheckPermission.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Permission;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('fail', 'You are not permitted to access this menu');
        }

        $roleId = $user->role_id;
        $currentRouteName = Route::currentRouteName();

        // Cek apakah permission ada untuk role_id dan routeName
        $hasPermission = Permission::where('role_id', $roleId)
            ->whereHas('menu', function($query) use ($currentRouteName) {
                $query->where('route', $currentRouteName);
            })
            ->exists();

        if ($hasPermission) {
            return $next($request);
        } else {
            return redirect()->back()->with('fail', 'You are not permitted to access this menu');
        }
    }
}
