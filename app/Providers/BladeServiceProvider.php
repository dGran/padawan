<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
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
        \Blade::if('admin', function() {
            return auth()->check() && auth()->user()->is_admin;
        });

        \Blade::directive('dd', function($expression) {
            return "<?php dd($expression); ?>";
        });
    }
}
