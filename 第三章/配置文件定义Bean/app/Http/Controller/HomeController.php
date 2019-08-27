<?php declare(strict_types=1);

namespace App\Http\Controller;

use App\Bean\Sunny;
use App\Bean\SunnySms;
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
        /** @var SunnySms $sunnySms */
        $sunnySms = \bean('testSunnyTest');
        $sunnySms->mailSend();
        $sunnySms->smsSend();
        return \context()->getResponse()->withContent("");
    }

}
