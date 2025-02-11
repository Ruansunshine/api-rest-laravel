<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        // Configura o rate limiting (limitação de taxa de requisições)
        $this->configureRateLimiting();

        // Define as rotas da aplicação
        $this->routes(function () {
            // Rotas da API
            Route::middleware('api')
                ->prefix('api') // Prefixo "/api" para todas as rotas da API
                ->group(base_path('routes/api.php')); // Carrega o arquivo routes/api.php

            // Rotas da Web
            Route::middleware('web')
                ->group(base_path('routes/web.php')); // Carrega o arquivo routes/web.php
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        // Define um limite de 60 requisições por minuto para a API
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}