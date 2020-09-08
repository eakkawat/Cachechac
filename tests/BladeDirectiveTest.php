<?php

use Eakkawat\Cachee\BladeDirective;
use Eakkawat\Cachee\RussianCaching;

class BladeDirectiveTest extends TestCase
{
    protected $cache;

    /** @test */
    public function it_sets_up_the_opening_cache_directive()
    {
        $directive = $this->createNewCacheDirective();

        $isCached = $directive->setUp($post = $this->makePost());

        $this->assertFalse($isCached);

        echo '<div>Fragment</div';

        $cachedFragment = $directive->tearDown();
        
        $this->assertEquals('<div>Fragment</div', $cachedFragment);
        $this->assertTrue($this->cache->has($post));

    }

    protected function createNewCacheDirective(){

        $setCache = new \Illuminate\Cache\Repository(
            new \Illuminate\Cache\ArrayStore()
        );
        $this->cache = new RussianCaching($setCache);

        return new BladeDirective($this->cache);
    }

}