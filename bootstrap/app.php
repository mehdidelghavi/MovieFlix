<?php

use App\Models\Genres;
use App\Models\MovieList;
use Illuminate\Auth\Access\AuthorizationException;
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
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'stripe/*',
            'api/external-callback',
            '/checkout/callback/*' // آدرس روت مورد نظر شما
        ]);
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthorizationException $e, Request $request){
            return response()->view('vendor.errors.dashboard-403', [], 403);
        });
        $exceptions->render(function (NotFoundHttpException $e, Request $request){
            if ($request->is('dashboard/*') || $request->is('dashboard')){
                return response()->view('vendor.errors.dashboard-404', [], 404);
            }
            $genres = Genres::all();
            $lists = MovieList::all()->sortByDesc("updated_at");
            return response()->view('vendor.errors.404', ['genres' => $genres, 'lists' => $lists], 404);
        });
        
})->create();
