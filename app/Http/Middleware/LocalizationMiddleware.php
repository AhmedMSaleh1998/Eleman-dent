<?php 

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;

class LocalizationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        app()->setLocale($request->header('Accept-Language', config('app.locale')));

        return $next($request);
    }
}