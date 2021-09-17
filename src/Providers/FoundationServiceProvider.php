<?php

namespace Gus\Foundation\Providers;

use Illuminate\Support\ServiceProvider;
use LogicException;

class FoundationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/gus_foundation.php', 'gus_foundation'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/gus_foundation.php' => config_path('gus_foundation.php'),
        ]);
    }
}
