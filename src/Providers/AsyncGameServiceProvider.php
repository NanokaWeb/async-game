<?php

namespace NanokaWeb\AsyncGame\Providers;

use Barryvdh\Cors\ServiceProvider as BarryvdhCorsServiceProvider;
use Dingo\Api\Provider\LaravelServiceProvider as LaravelDingoApiServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use NanokaWeb\AsyncGame\Api\V1\Middleware\CheckRole;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdkServiceProvider;
use Tymon\JWTAuth\Providers\JWTAuthServiceProvider;
use Vinkla\Hashids\HashidsServiceProvider;

class AsyncGameServiceProvider extends LaravelServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(Router $router) {
        $this->handleMigrations();
        // $this->handleViews();
        // $this->handleTranslations();
        $this->handleRouteMiddlewares($router);
        $this->handleRoutes();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        // Bind any implementations.
        $this->handleConfigs();
        $this->app->register(JWTAuthServiceProvider::class);
        $this->app->register(LaravelDingoApiServiceProvider::class);
        $this->app->register(LaravelFacebookSdkServiceProvider::class);
        $this->app->register(BarryvdhCorsServiceProvider::class);
        $this->app->register(HashidsServiceProvider::class);

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }

    private function handleConfigs() {
        $configPath = __DIR__ . '/../../config/async-game.php';
        $this->publishes([$configPath => config_path('async-game.php')]);
        $this->mergeConfigFrom($configPath, 'async-game');

        $configPath = __DIR__ . '/../../config/jwt.php';
        $this->publishes([$configPath => config_path('jwt.php')]);
        $this->mergeConfigFrom($configPath, 'jwt');

        $configPath = __DIR__ . '/../../config/api.php';
        $this->publishes([$configPath => config_path('api.php')]);
        $this->mergeConfigFrom($configPath, 'api');

        $configPath = __DIR__ . '/../../config/cors.php';
        $this->publishes([$configPath => config_path('cors.php')]);
        $this->mergeConfigFrom($configPath, 'cors');

    }

    private function handleTranslations() {
        $this->loadTranslationsFrom(__DIR__.'/../../lang', 'async-game');
    }

    private function handleViews() {
        $this->loadViewsFrom(__DIR__.'/../../views', 'async-game');
        $this->publishes([__DIR__.'/../../views' => base_path('resources/views/vendor/async-game')]);
    }

    private function handleMigrations() {
        $this->publishes([
            __DIR__ . '/../migrations' => base_path('database/migrations')
        ], 'migrations');
    }

    private function handleRouteMiddlewares($router) {
        $router->middleware('asyncgame.roles', CheckRole::class);
    }

    private function handleRoutes() {
        include __DIR__.'/../Api/V1/api_routes.php';
    }
}
