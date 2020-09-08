<?php

use Eakkawat\Cachee\RussianCaching;

class RussianCachingTest extends TestCase{

    /** @test */
    public function it_caches_the_given_key(){

        $post = $this->makePost();

        $setCache = new \Illuminate\Cache\Repository(
            new \Illuminate\Cache\ArrayStore()
        );
        $cache = new RussianCaching($setCache);

        $cache->put($post, '<div>view fragment</div>');

        $this->assertTrue($cache->has($post->getCacheKey()));
        $this->assertTrue($cache->has($post));
        
    }
    
}