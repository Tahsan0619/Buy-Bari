<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo('/admin/login');
        $middleware->redirectUsersTo('/admin');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if (! $request->is('admin', 'admin/*')) {
                return null;
            }

            $target = match (true) {
                $request->is('admin/orders*') => '/admin/orders',
                $request->is('admin/products*') => '/admin/products',
                $request->is('admin/banners*') => '/admin/banners',
                $request->is('admin/categories*') => '/admin/categories',
                $request->is('admin/messages*') => '/admin/messages',
                default => '/admin',
            };

            return redirect($target)->with('status', 'That record could not be found.');
        });
    })->create();
