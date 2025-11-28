<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            // Frontend routes
            Route::middleware('web')
                 ->group(base_path('routes/frontend.php'));

            // Backend/Admin routes
            Route::prefix('admin') // optional prefix for backend URLs
                 ->middleware(['web', 'auth', 'admin']) // backend-specific middleware
                 ->group(base_path('routes/backend.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
