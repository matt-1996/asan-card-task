<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
        then: function(){
            Route::prefix('api/news-api')->group(base_path('routes/NewsApi.php'))->middleware(['throttle:100,1']);
            Route::prefix('api/ny-times')->group(base_path('routes/NYTimes.php'))->middleware(['throttle:100,1']);
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
        ]);
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);


        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
