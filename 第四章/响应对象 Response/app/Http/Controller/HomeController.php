<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2019 http://www.sunnyos.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-09-03 21:57:33
 * | Author: Sunny (admin@mail.sunnyos.com) QQ：327388905
 * +----------------------------------------------------------------------
 */

namespace App\Http\Controller;

use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;

/**
 * @Controller()
 */
class HomeController
{

    /**
     * @RequestMapping(route="/status")
     */
    public function status(Response $response)
    {
        return $response->withStatus(404);
    }

    /**
     * @RequestMapping(route="/content")
     */
    public function content()
    {
        $response = context()->getResponse();
        return $response->withContent("ajsiojdaoi");
    }

    /**
     * @RequestMapping(route="/data")
     */
    public function data()
    {
        $response = context()->getResponse();
        return $response->withData(['msg' => '哈哈哈哈', 'asjio' => 'asjiodajioj']);
    }

    /**
     * @RequestMapping(route="/head")
     */
    public function withHeader()
    {
        $response = context()->getResponse();

        return $response->withHeader("name", "sunny")
            ->withHeader("qq", "327388905")
            ->withContent("你好");
    }

    /**
     * @RequestMapping(route="/redirect")
     */
    public function redirect()
    {
        $response = context()->getResponse();
        return $response->redirect("https://www.ngrok.cc");
    }

    /**
     * @RequestMapping(route="/file")
     */
    public function file()
    {
        $response = context()->getResponse();
        return $response->file(\alias("@runtime/file/11.jpeg"),"application/octet-stream");
    }
}
