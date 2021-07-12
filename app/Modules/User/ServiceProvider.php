<?php
/**
 * Created by PhpStorm.
 * File: ServiceProvider.php
 * Project: lumen
 * Module: hnher
 * DateTime: 2021-06-02 17:05:35
 */

namespace App\Modules\User;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->singleton('user', function ($app) {
            return new Module();
        });
    }

    public function boot()
    {

    }
}
