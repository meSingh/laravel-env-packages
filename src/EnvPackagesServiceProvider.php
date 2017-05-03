<?php

namespace meSingh\EnvPackages;

use App;
use Illuminate\Support\ServiceProvider;

class EnvPackagesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/envpackages.php',
            'envpackages'
        );

        $this->publishes([
            __DIR__.'/../config/envpackages.php' => config_path('envpackages.php'),
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            \meSingh\EnvPackages\Console\GenerateCommand::class
        ]);
        $this->registerPackages();
    }

    /**
     * Register any environment specifc packages.
     *
     * @return void
     */
    public function registerPackages()
    {
        if (! file_exists(app_path('../envpackages.lock'))) {
            return;
        }

        $config = json_decode(file_get_contents(app_path('../envpackages.lock')), true);

        // Register ServiceProviders
        if (isset($config['providers'][ $this->app->environment() ])) {
            foreach ($config['providers'][ $this->app->environment() ] as $provider) {
                $this->app->register($provider);
            }
        }

        // Register Alias
        if (isset($config['aliases'][ $this->app->environment() ])) {
            foreach ($config['aliases'][ $this->app->environment() ] as $key => $alias) {
                $this->app->config->push('app.aliases', [$key => $alias]);
            }
        }

        // Register Middlewares
        if (isset($config['middlewares'][ $this->app->environment() ])) {
            foreach ($config['middlewares'][ $this->app->environment() ] as $middleware) {
                $kernel = $this->app->make('Illuminate\Contracts\Http\Kernel');
                $kernel->pushMiddleware($middleware);
            }
        }

        // Register Router Middlewares
        if (isset($config['routerMiddlewares'][ $this->app->environment() ])) {
            foreach ($config['routerMiddlewares'][ $this->app->environment() ] as $key => $middleware) {
                $this->app->router->aliasMiddleware($key, $middleware);
            }
        }
    }
}
