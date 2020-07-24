<?php

namespace Eakkawat\Cachee;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class CacheeServiceProvider extends ServiceProvider
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
        Blade::directive('cache', function ($expression) {
            return "<?php if (! Eakkawat\Cachee\RussianCaching::setUp({$expression})) {  ?>";
        });

        Blade::directive('endcache', function () {
            return "<?php } ?><?= Eakkawat\Cachee\RussianCaching::tearDown()  ?>";
        });
    }
}
