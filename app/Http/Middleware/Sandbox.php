<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Sandbox
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
        //return $next($request);
        //return route('app.home');


        if(auth()->user()->hasRole('SANDBOX')){
            return $next($request);
        }else{
            abort(403);
        }
        
    }
}
