<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\redirectAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);
<<<<<<< HEAD

        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'redirectAdmin' => \App\Http\Middleware\redirectAdmin::class,
        ]);
=======
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'redirectAdmin' => redirectAdmin::class,
        ]);
        //
>>>>>>> bdb5ef0 (projet final)
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
