<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repositories\RepositoryInterfaces\UserRepositoryInterface;
use App\Repositories\RepositoryInterfaces\CustomerRepositoryInterface;
use App\Repositories\RepositoryInterfaces\GardenerRepositoryInterface;
use App\Repositories\RepositoryInterfaces\CountryRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\GardenerRepository;
use App\Repositories\CountryRepository;


class RepositoriesServiceProvider extends ServiceProvider
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
    public function boot()
    {

        $this->app->bind( UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind( CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind( GardenerRepositoryInterface::class, GardenerRepository::class);
        $this->app->bind( CountryRepositoryInterface::class, CountryRepository::class);

    }
}
