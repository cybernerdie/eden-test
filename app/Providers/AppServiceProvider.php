<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $customers = Cache::rememberForever('customers', function (){
            return User::where( 'role_id', 9 )->with('gardener')->orderBy( 'created_at', 'desc' )->paginate();
        });

        $gardeners = Cache::rememberForever('gardeners', function (){
            return User::where( 'role_id', 18 )->with('customers')->orderBy( 'created_at', 'desc' )->paginate();
        });

        view()->share( compact('customers', 'gardeners') );
    }
}
