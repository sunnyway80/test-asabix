<?php

namespace App\Providers;

use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Repositories\PostRepository;
use App\Repositories\TagRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider.
 */
class RepositoryServiceProvider extends ServiceProvider
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
    public function boot(): void
    {
        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class
        );
        $this->app->bind(
            TagRepositoryInterface::class,
            TagRepository::class
        );
    }
}
