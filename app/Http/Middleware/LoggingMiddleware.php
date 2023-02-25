<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoggingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $message = "Path: " . $request->path();
        $message .= $request->user() ? "\nUserEmail: " . $request->user()->email : '';
        \Log::info($message);
        return $next($request);
    }
}
