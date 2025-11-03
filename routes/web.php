<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// Debug route to check session and CSRF
Route::get('/debug-session', function (Request $request) {
    return response()->json([
        'session_id' => $request->session()->getId(),
        'csrf_token' => csrf_token(),
        'session_token' => $request->session()->token(),
        'session_started' => $request->session()->isStarted(),
        'session_data' => $request->session()->all(),
        'cookies' => $request->cookies->all(),
        'app_url' => config('app.url'),
        'session_config' => [
            'driver' => config('session.driver'),
            'domain' => config('session.domain'),
            'path' => config('session.path'),
            'secure' => config('session.secure'),
            'same_site' => config('session.same_site'),
        ],
    ]);
});

// CSRF test page
Route::get('/csrf-test', function () {
    return view('csrf-test');
});

// Test CSRF route
Route::post('/test-csrf', function (Request $request) {
    return response()->json(['message' => 'CSRF test successful', 'data' => $request->all()]);
})->name('test.csrf');
