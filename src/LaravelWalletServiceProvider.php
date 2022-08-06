<?php

namespace Aldijakaria\LaravelWallet;

use Illuminate\Support\ServiceProvider;

class LaravelWalletServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
}
