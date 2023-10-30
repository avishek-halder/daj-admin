<?php

namespace App\Http\Middleware;

use Closure;
use AdminHelper;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {        
        if (AdminHelper::myId() == '') {
            $url = AdminHelper::adminpath('login');

            return redirect($url);
        }

        if (AdminHelper::isLocked()) {
            $url = AdminHelper::adminpath('lock-screen');

            return redirect($url);
        }

        return $next($request);
    }
}
