<?php

namespace Eakkawat\Cachee;

use Cache;

class RussianCaching
{
    protected static $keys = [];

    public static function setUp($model)
    {
        static::$keys[] = $key = $model->getCacheKey();

        ob_start();
        
        return Cache::tags('view')->has($key);

    }

    public static function tearDown()
    {
        $key = array_pop(static::$keys);

        $html = ob_get_clean();
    
        // search key in cache and return it if found
        // if not then store html in cache
        return Cache::tags('view')->rememberForever($key, function() use ($html){
            return $html;
        });

    }
}
