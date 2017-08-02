<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware {

    protected $auth;

    public function __construct(Guard $auth) {
        $this->auth = $auth;

    }

    public function handle($request, Closure $next, $guard = null) {
        if (\Auth::check() && \Auth::user()->is_admin == 1) {
            return $next($request);
        }

        return redirect()->guest('admin/login');
    }
}
