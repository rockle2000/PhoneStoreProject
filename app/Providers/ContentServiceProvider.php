<?php

namespace App\Providers;

use App\Models\Supplier;
use Illuminate\Support\ServiceProvider;

class ContentServiceProvider extends ServiceProvider
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
        //
        view()->composer('layouts.home_layout', function ($view) {
            $view->with(['supplier' => Supplier::where('TrangThai', '=', 1)->get()]);
        });
    }
}
