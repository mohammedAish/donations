<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AgeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$age)
    {
        if ($age < 18) {
            abort(403, 'Age restrictions');
        }
        return $next($request);
        //*************************************/
        // $age = 17;
        // $response = $next($request);
        // if ($age < 18) {
        //     abort(403, 'Age restrictions');
        // }
        // return $response;
    }
}
