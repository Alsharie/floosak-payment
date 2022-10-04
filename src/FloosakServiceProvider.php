<?php

namespace Alsharie\FloosakPayment;

use Illuminate\Support\ServiceProvider;

class  FloosakServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Config file
        $this->publishes([
            __DIR__ . '/../config/floosak.php' => config_path('floosak.php'),
        ]);

        // Merge config
        $this->mergeConfigFrom(__DIR__ . '/../config/floosak.php', 'Floosak');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Floosak::class, function () {
            return new Floosak();
        });

    }
}