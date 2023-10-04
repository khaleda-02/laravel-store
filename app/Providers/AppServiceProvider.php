<?php

namespace App\Providers;

use App\Repos\Cart\CartModelRepo;
use App\Repos\Cart\CartRepo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CartRepo::class, function () {
            return new CartModelRepo();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFour();
        // my_NOTE: to app a custom paginator style for the entire project : Paginator::defaultView(view.path);
    }
}
