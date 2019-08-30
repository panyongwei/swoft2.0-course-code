<?php
namespace App\Http\Controller;
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
        \Swoft::trigger("sunny.task","",['name'=>'sunny']);
        return context()->getResponse()->withContent("aa");
    }

}
