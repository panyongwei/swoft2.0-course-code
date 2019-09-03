<?php

namespace App\Exception\Handler;


use App\Exception\SunnyException;
use App\Exception\SunnyException007;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;
use Throwable;

/**
 * @ExceptionHandler({SunnyException::class,SunnyException007::class})
 */
class SunnyHandler extends AbstractHttpErrorHandler
{

    /**
     * @param Throwable $e
     * @param Response $response
     *
     * @return Response
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     */
    public function handle(Throwable $e, Response $response): Response
    {
        return $response->withContent("捕获异常：" . $e->getMessage());
    }
}
