<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\BannedMiddleware;
use App\Http\Middleware\SellerMiddleware;
use App\Http\Middleware\CustomerMiddleware;
use App\Http\Middleware\AdminInfoMiddleware;
use App\Http\Middleware\DeliveryAgentMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'customer' => CustomerMiddleware::class,
            'seller' => SellerMiddleware::class,
            'deliveryAgent' => DeliveryAgentMiddleware::class,
            'banned' => BannedMiddleware::class,

        ]);
        $middleware->web([
            AdminInfoMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
