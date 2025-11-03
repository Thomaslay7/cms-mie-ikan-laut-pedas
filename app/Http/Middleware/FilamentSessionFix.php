<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FilamentSessionFix
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        // Force start session for Filament routes
        if ($request->is('admin/*')) {
            if (!$request->session()->isStarted()) {
                $request->session()->start();
            }

            // Regenerate CSRF token if needed
            if (!$request->session()->has('_token')) {
                $request->session()->regenerateToken();
            }

            if (app()->environment('local')) {
                Log::info('Filament Session Fix Applied', [
                    'url' => $request->url(),
                    'session_id' => $request->session()->getId(),
                    'session_started' => $request->session()->isStarted(),
                    'has_token' => $request->session()->has('_token'),
                ]);
            }
        }

        return $next($request);
    }
}
