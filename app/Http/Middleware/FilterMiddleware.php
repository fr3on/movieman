<?php

namespace App\Http\Middleware;

class CheckForMaintenanceMode {

    public function handle($request, Closure $next)
{
    if ($this->app->isDownForMaintenance() &&
        !in_array($request->ip(), ['123.123.123.123', '124.124.124.124']))
    {
        return response('Be right back!', 503);
    }

    return $next($request);
}
}
