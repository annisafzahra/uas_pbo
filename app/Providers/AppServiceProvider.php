<?php

namespace App\Providers;

use App\Services\UsulService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\UsulanBukuRepository;
use App\Repositories\Contracts\UsulanBukuRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UsulanBukuRepositoryInterface::class, UsulanBukuRepository::class);

        $this->app->bind(UsulService::class, function ($app) {
            return new UsulService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
