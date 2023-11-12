<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPostSize
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
         // Adjust the limit as needed (in kilobytes)
    $maxPostSize = 2048000; // 2 GB

    // Check the request size
    if ($request->server('CONTENT_LENGTH') > $maxPostSize) {
        return response(['error' => 'Request entity too large.'], 413);
    }

        return $next($request);
    }
}
