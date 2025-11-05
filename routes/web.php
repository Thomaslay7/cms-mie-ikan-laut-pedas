<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect('/admin');
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

// Database connection test route for Hostinger debugging
Route::get('/test-db', function () {
    try {
        $pdo = DB::connection()->getPdo();
        $version = DB::select('SELECT VERSION() as version')[0];

        return response()->json([
            'status' => 'success',
            'message' => 'Database connected successfully',
            'mysql_version' => $version->version,
            'config' => [
                'host' => config('database.connections.mysql.host'),
                'port' => config('database.connections.mysql.port'),
                'database' => config('database.connections.mysql.database'),
                'username' => config('database.connections.mysql.username'),
                'password' => str_repeat('*', strlen(config('database.connections.mysql.password'))),
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'config' => [
                'host' => config('database.connections.mysql.host'),
                'port' => config('database.connections.mysql.port'),
                'database' => config('database.connections.mysql.database'),
                'username' => config('database.connections.mysql.username'),
            ]
        ], 500);
    }
});

// Environment info route
Route::get('/env-info', function () {
    return response()->json([
        'app_env' => config('app.env'),
        'app_debug' => config('app.debug'),
        'app_url' => config('app.url'),
        'cache_store' => config('cache.default'),
        'session_driver' => config('session.driver'),
        'db_connection' => config('database.default'),
    ]);
});
