<?php

namespace Eakkawat\Cachee;

use Illuminate\Support\Facades\Cache;

class FlushView {

    public function handle($request, $next)
    {
        if(app()->environment() === 'local'){
            Cache::tags('view')->flush();
        }

        return $next($request);
    }
    
}