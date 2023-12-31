<?php
declare(strict_types=1);

namespace App\Providers;

use App\Services\KanyeQuotes\KanyeQuotesManager;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            abstract: KanyeQuotesManager::class,
            concrete: fn (Application $app) => new KanyeQuotesManager($app),
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
