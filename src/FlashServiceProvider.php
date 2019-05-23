<?php

namespace Spatie\Flash;

use Illuminate\Support\ServiceProvider;

class FlashServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'flash');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/flash'),
        ]);
    }
}
