<?php

namespace App\Providers;

use App\Models\Admin\Property;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        $views = ['user.welcome'];
        View::composer($views, function ($view){
//            $properties = Property::where('status', 1)->get();
//            $view->with('properties', $properties);
        });
    }
}
