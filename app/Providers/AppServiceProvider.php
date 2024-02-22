<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Values\CompositionToken;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Menu\MenuRepositoryInterface;
use App\Repositories\Menu\MenuRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        UserRepositoryInterface::class => UserRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
        MenuRepositoryInterface::class => MenuRepository::class
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            CompositionToken::class,
            function () {
                return new CompositionToken('', '', null);
            }
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
