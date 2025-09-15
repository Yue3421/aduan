<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::guard('petugas')->check() || Auth::guard('petugas')->user()->level !== $role) {
            abort(403, 'Akses ditolak. Anda tidak memiliki peran yang sesuai.');
        }
        return $next($request);
    }
}