<?php

namespace App\Http\Controller;

use Firebase\JWT\JWT;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;

/**
 * @Controller()
 */
class HomeController
{
    /**
     * @RequestMapping(route="/login")
     */
    public function index()
    {
        // 登陆成功使用jwt返回token
        $private = \config('jwt.privateKey');
        $exp = \config('jwt.exp');
        $type = \config('jwt.type');

        $tokenParam = [
            'user' => 120,// 用户id
            'iat' => time(),// 创建时间
            'exp' => time() + $exp,//过期时间
        ];
        $token = JWT::encode($tokenParam, $private, $type);
        return context()->getResponse()->withContent($token);
    }

    /**
     * @RequestMapping(route="/jwt")
     * @param Request $request
     * @return \Swoft\Http\Message\Response|\Swoft\Rpc\Server\Response
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Exception\SwoftException
     */
    public function jwt(Request $request)
    {
        $user = $request->user;
        return context()->getResponse()->withContent("jwt用户验证成功用户id是：{$user}\n");
    }
}
