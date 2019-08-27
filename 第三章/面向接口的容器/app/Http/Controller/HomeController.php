<?php declare(strict_types=1);

namespace App\Http\Controller;

use App\Bean\CRedis;
use App\Bean\Interfaces\ICache;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Throwable;

/**
 * Class HomeController
 * @Controller()
 */
class HomeController
{

    /**
     * @RequestMapping("/")
     * @throws Throwable
     */
    public function index(): Response
    {
        /** @var ICache $cache */
        $cache = \bean(ICache::class);
        $cache->set("name", "sunny");

        /** @var ICache $cache1 */
        $cache1 = \bean(CRedis::class);
        $cache1->set("name","sunny");
        return \context()->getResponse()->withContent("");
    }

}
