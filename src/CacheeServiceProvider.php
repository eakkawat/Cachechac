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
        $this->app->singleton(BladeDirective::class, function(){
            
            $setCache = new \Illuminate\Cache\Repository(
                new \Illuminate\Cache\ArrayStore()
            );
            $cache = new RussianCaching($setCache);

            return new BladeDirective($cache);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('cache', function ($expression) {
            return "<?php if (! app('Eakkawat\Cachee\BladeDirective')->setUp({$expression})) {  ?>";
        });

        Blade::directive('endcache', function () {
            return "<?php } ?><?= app('Eakkawat\Cachee\BladeDirective')->tearDown()  ?>";
        });
    }
}
