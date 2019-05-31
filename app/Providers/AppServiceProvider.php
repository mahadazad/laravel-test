<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\BusinessDayCalculator\BusinessDayCalculator;
use App\Service\BusinessDayCalculator\BusinessDateWithDelay;
use App\Service\BusinessDayCalculator\RedisPubSub;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Service\BusinessDayCalculator\BusinessDayCalculatorInterface', function () {
            $default = config('business-days.default');
            $allHolidays = config('business-days.holidays');
            $holidays = $allHolidays[$default] ?? [];

            return new BusinessDayCalculator($holidays);
        });

        $this->app->singleton('App\Service\BusinessDayCalculator\BusinessDateWithDelay', function ($app) {
            $calculator = $app->make('App\Service\BusinessDayCalculator\BusinessDayCalculatorInterface');
            return new BusinessDateWithDelay($calculator);
        });

        $this->app->singleton('App\Service\BusinessDayCalculator\BusinessDatesPubSubInterface', function ($app) {
            return new RedisPubSub();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
