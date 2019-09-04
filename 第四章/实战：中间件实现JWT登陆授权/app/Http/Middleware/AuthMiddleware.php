<?php
namespace App\Http\Middleware;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Http\Server\Contract\MiddlewareInterface;

/**
 * @Bean()
 */
class AuthMiddleware implements MiddlewareInterface
{

    /**
     * Process an incoming server request.
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Exception\SwoftException
     * @inheritdoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // 排除登陆接口，登陆接口不需要验证jwt
        $path = $request->getUri()->getPath();
        if ($path == '/login') {
            $response = $handler->handle($request);
            return $response;
        }
        $token = $request->getHeaderLine("token");
        $type = \config('jwt.type');
        $public = \config('jwt.publicKey');
        try {
            $auth = JWT::decode($token, $public, ['type' => $type]);
            // 挂在到Request请求对象
            $request->user = $auth->user;
        } catch (\Exception $e) {
            $json = ['code'=>0,'msg'=>'授权失败'];
            $response = context()->getResponse();
            return $response->withData($json);
        }
        $response = $handler->handle($request);
        return $response;
    }
}
