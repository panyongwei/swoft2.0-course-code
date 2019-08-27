<?php declare(strict_types=1);

namespace App\Http\Controller;

use App\Bean\Sunny;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Bean\BeanFactory;
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
     * @Inject()
     * @var Sunny
     */
    private $sunny;
    /**
     * @RequestMapping("/")
     * @throws Throwable
     */
    public function index(): Response
    {
        /** @var Sunny $sunny */
        //$sunny = \bean(Sunny::class);
        //$sunny = \Swoft::getBean("sunny001");
        //$sunny = BeanFactory::getBean(Sunny::class);
        $i = $this->sunny->getNum();
        $this->sunny->setNum($i + 1);
        return \context()->getResponse()->withContent($i . "");
    }

}
