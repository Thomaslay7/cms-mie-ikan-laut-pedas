<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Add any routes that should bypass CSRF if needed
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if (app()->environment('local')) {
            Log::info('CSRF Debug', [
                'url' => $request->url(),
                'method' => $request->method(),
                'session_token' => $request->session()->token(),
                'request_token' => $request->input('_token'),
                'header_token' => $request->header('X-CSRF-TOKEN'),
                'session_id' => $request->session()->getId(),
                'session_started' => $request->session()->isStarted(),
            ]);
        }

        try {
            return parent::handle($request, $next);
        } catch (TokenMismatchException $e) {
            if (app()->environment('local')) {
                Log::error('CSRF Token Mismatch', [
                    'url' => $request->url(),
                    'method' => $request->method(),
                    'session_token' => $request->session()->token(),
                    'request_token' => $request->input('_token'),
                    'header_token' => $request->header('X-CSRF-TOKEN'),
                    'session_id' => $request->session()->getId(),
                    'session_started' => $request->session()->isStarted(),
                    'user_agent' => $request->header('User-Agent'),
                    'referer' => $request->header('Referer'),
                ]);
            }

            // Re-throw the exception
            throw $e;
        }
    }
}
