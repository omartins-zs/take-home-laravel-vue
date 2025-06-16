<?php

namespace App\Providers;

use App\Models\Package;
use App\Observers\PackageObserver;
use App\Repositories\Contracts\ExamRepositoryInterface;
use App\Repositories\Contracts\PackageRepositoryInterface;
use App\Repositories\Eloquent\ExamRepository;
use App\Repositories\Eloquent\PackageRepository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ExamRepositoryInterface::class,
            ExamRepository::class
        );

        $this->app->bind(
            PackageRepositoryInterface::class,
            PackageRepository::class
        );

        $this->app->singleton('files', function () {
            return new Filesystem;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Package::observe(PackageObserver::class);
    }
}
