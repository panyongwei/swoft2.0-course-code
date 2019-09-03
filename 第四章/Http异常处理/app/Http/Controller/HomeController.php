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

use App\Exception\SunnyException;
use App\Exception\SunnyException007;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;

/**
 * @Controller()
 */
class HomeController
{
    /**
     * @RequestMapping(route="/")
     */
    public function index()
    {
        throw new SunnyException("我是index抛出的\n");
        return context()->getResponse()->withContent(time() . "\n");
    }

    /**
     * @RequestMapping(route="/007")
     */
    public function index007()
    {
        throw new SunnyException007("我是index007抛出的\n");
        return context()->getResponse()->withContent(time() . "\n");
    }
}
