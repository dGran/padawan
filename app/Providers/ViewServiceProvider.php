<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
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
        $navLayoutMenuLinks = [
            [
                'class' => '',
                'route-name' => 'gt-sport',
                'text' => 'GT'
            ],
            [
                'class' => '',
                'route-name' => 'gt-sport',
                'text' => 'Fifa'
            ],
            [
                'class' => '',
                'route-name' => 'gt-sport',
                'text' => 'eFootball'
            ],
            [
                'class' => '',
                'route-name' => 'eteams.index',
                'text' => 'Equipos e-sports'
            ],
            [
                'class' => '',
                'route-name' => 'eteams.index',
                'text' => 'Mercado'
            ],
            [
                'class' => 'hidden xl:inline-block',
                'route-name' => 'cookie-policy',
                'text' => 'Merchandising'
            ],
        ];

        View::share('navLayoutMenuLinks', $navLayoutMenuLinks);
    }
}
