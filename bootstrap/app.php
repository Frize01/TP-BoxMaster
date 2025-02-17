<?php

use App\Http\Middleware\OwnerBox;
use App\Http\Middleware\OwnerModel;
use App\Http\Middleware\OwnerTenant;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'ownerBox' => OwnerBox::class,
            'ownerTenant' => OwnerTenant::class,
            'ownerModel' => OwnerModel::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
