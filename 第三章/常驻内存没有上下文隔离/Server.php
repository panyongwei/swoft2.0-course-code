<?php
require_once "./BaseController.php";
require_once "./Controller.php";

class Server
{
    private $server;
    private $controller;

    public function __construct()
    {
        $this->controller = new Controller();
        $this->server = new Swoole\Http\Server("127.0.0.1", 9501);
        $this->server->on('request', function ($request, $response) {
            $c = $request->get['c'] ?? 'index';
            $res = call_user_func([$this->controller, $c]);
            $response->end($res);
        });
        $this->server->start();
    }
}

new Server();