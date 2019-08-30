<?php
namespace App\Http\Controller;
use App\Annotation\Mapping\Sunny;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Throwable;

/**
 * Class HomeController
 * @Controller()
 * @Sunny(name="My name is sunny")
 */
class HomeController
{
    /**
     * @RequestMapping("/")
     * @throws Throwable
     */
    public function index(): Response
    {
        return context()->getResponse()->withContent("aa");
    }

}
