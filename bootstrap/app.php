<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
            ConvertEmptyStringsToNull::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

$app->singleton(
    \Illuminate\Contracts\Console\Kernel::class,
    \App\Console\Kernel::class
);

return $app;
