<?php

namespace App\Providers;

use App\Contracts\LocationRepositoryInterface;
use App\Support\LocationRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //dd(LocationRepositoryInterface::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
    }
}
