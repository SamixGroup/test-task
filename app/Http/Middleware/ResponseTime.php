<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResponseTime
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
        $memory_start = memory_get_usage();
        $response = $next($request);
        $content = json_decode($response->content(), true);

        if (defined('LARAVEL_START')) {
//
//            $response->headers->add(['X-RESPONSE-TIME' => microtime(true) - LARAVEL_START]);
//            $response->headers->add(['X-MEMORY-USAGE' => memory_get_usage() - $memory_start]);
            $content['response_time'] = microtime(true) - LARAVEL_START;
            $content['memory_usage'] = memory_get_usage() - $memory_start;
        }

        $response->setContent(json_encode($content));
        return $response;
    }
}
