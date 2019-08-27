<?php declare(strict_types=1);

namespace App\Http\Controller;

use App\Bean\Sunny;
use App\Bean\Sunny001;
use App\Bean\Sunny002;
use Swoft\Bean\BeanFactory;
use Swoft\Co;
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
        /** @var Sunny $sunny */
        $sunny = \bean(Sunny::class);
        echo $sunny->getNum();

        /** @var Sunny001 $sunny */
        $sunny001 = \bean(Sunny001::class);
        echo $sunny001->getNum();

        $tid = (string)Co::tid();
        /** @var Sunny002 $sunny002 */
        $sunny002 = BeanFactory::getRequestBean(Sunny002::class, $tid);
        echo $sunny002->getNum();
        return \context()->getResponse()->withContent("");
    }

}
