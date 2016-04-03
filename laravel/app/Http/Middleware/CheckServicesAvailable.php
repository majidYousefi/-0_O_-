<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CheckServicesAvailable
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
        if(!isset(Session::get("services")[$request->route()->parameters()['servId']]))
             return view("access_denied");
        return $next($request);
    }
}
