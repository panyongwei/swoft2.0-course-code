<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2019 http://www.sunnyos.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-09-04 17:22:11
 * | Author: Sunny (admin@mail.sunnyos.com) QQ：327388905
 * +----------------------------------------------------------------------
 */

namespace App\Http\Controller;


use App\Http\Middleware\User001Middleware;
use App\Http\Middleware\User007Middleware;
use App\Http\Middleware\UserAddMiddleware;
use App\Http\Middleware\UserMiddleware;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\Middlewares;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;

/**
 * @Controller()
 * @Middlewares({
 *  @Middleware(User001Middleware::class),
 *  @Middleware(User007Middleware::class),
 * })
 * @Middleware(UserMiddleware::class)
 */
class UserController
{
    /**
     * @RequestMapping(route="list")
     */
    public function list()
    {
        echo "UserController list\n";
        return time()."\n";
    }

    /**
     * @RequestMapping(route="add")
     * @Middleware(UserAddMiddleware::class)
     */
    public function add(){

        echo "UserController add\n";
        return time()."\n";
    }
}
