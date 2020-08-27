<?php

namespace App\Providers;

use Faker\Generator;
use Faker\Provider\Base;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        $this->app->extend(Generator::class, function (Generator $generator) {
            $generator->addProvider(new class($generator) extends Base {
                static $index = 1;

                public function index()
                {
                    return static::$index++;
                }

                public function resetIndex()
                {
                    static::$index = 1;
                }
            });

            return $generator;
        });

        Paginator::defaultView('vendor.pagination.bulma');
    }
}
