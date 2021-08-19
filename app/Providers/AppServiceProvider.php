<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // $usersOnline = \App\Models\Session::whereNotNull('user_id')->distinct('user_id')->count('user_id');
        $usersOnline = 0;
        view()->share('usersOnline', $usersOnline);
        // $visitorsOnline = \App\Models\Session::whereNull('user_id')->distinct('ip_address')->count('ip_address');
        $visitorsOnline = 0;
        view()->share('visitorsOnline', $visitorsOnline);
    }
}
