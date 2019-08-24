<?php
Swoole\Runtime::enableCoroutine(true);
$_array = [];
$http = new swoole_http_server("127.0.0.1", 9501);
$http->set(['worker_num' => 1]);
$http->on("start", function ($server) {
});
$http->on("request", function ($request, $response) {
    global $_array;
    if ($request->server['request_uri'] == '/a') {
        echo "---------a请求修改前-----------\n";
        print_r($_array);
        echo "---------a请求修改前-----------\n";

        $_array['key'] = "aaaa";
        sleep(2);

        echo "---------a请求修改后-----------\n";
        print_r($_array);
        echo "---------a请求修改后-----------\n";
        $response->end();
    } else {
        echo "---------其他请求修改前-----------\n";
        print_r($_array);
        echo "---------其他请求修改前-----------\n";

        $_array['key'] = "其他请求";

        echo "---------其他请求修改后-----------\n";
        print_r($_array);
        echo "---------其他请求修改后-----------\n";
        $response->end();
    }
});

$http->start();