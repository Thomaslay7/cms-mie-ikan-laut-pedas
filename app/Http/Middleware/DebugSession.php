<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DebugSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (app()->environment('local')) {
            Log::info('Debug Session Middleware', [
                'session_id' => $request->session()->getId(),
                'csrf_token' => $request->session()->token(),
                'request_token' => $request->input('_token'),
                'session_started' => $request->session()->isStarted(),
                'session_data' => $request->session()->all(),
                'cookies' => $request->cookies->all(),
                'url' => $request->url(),
                'method' => $request->method(),
            ]);
        }

        return $next($request);
    }
}
