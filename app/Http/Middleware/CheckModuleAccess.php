<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleAccess
{
    public function handle(Request $request, Closure $next, string $module, string $permission = 'view'): Response
    {
        if (!$request->user()) {
            return redirect('/login');
        }

        if (!$request->user()->hasAccess($module, $permission)) {
            abort(403, 'Bu modüle erişim yetkiniz yok.');
        }

        return $next($request);
    }
}
