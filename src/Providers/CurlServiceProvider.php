<?php

namespace csi0n\Curl\Providers;

use Illuminate\Support\ServiceProvider;

class CurlServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('csi0n.laravel.curl', function () {
            return new \csi0n\Curl\Repositories\CurlRepository();
        });
    }
}
