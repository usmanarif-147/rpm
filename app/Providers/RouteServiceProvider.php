<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const USER_DASHBOARD = '/user/dashboard';
    public const ADMIN_DASHBOARD = '/admin/dashboard';
    public const DRIVER_DASHBOARD = '/driver/dashboard';
    public const MANAGER_DASHBOARD = '/manager/dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            /**
             * User Routes File
            */
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            /**
             * Admin Routes File
             */
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/admin.php'));

            /**
             * Driver Routes File
             */
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/driver.php'));

            /**
             * Manager Routes File
             */
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/manager.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
