<?php

use App\Utils\Utils;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (NotFoundHttpException $e) {
            return Utils::renderException($e, message: 'No results found', code: 404);
        });
        $exceptions->render(function (InvalidFormatException $e) {
            return Utils::renderException($e, message: 'No results found', code: 404);
        });

    })->create();
