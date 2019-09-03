<?php
include './MysqlPool.php';
//创建http server
$http = new Swoole\Http\Server("0.0.0.0", 9501);
$http->set(["worker_num" => 1]);
$http->on('WorkerStart', function ($serv, $worker_id) {
    $config = [
        'min' => 3,
        'max' => 5,
        'time_out' => 1,
        'db_host' => '127.0.0.1',
        'db_user' => 'root',
        'db_passwd' => 'sunny123',
        'database' => 'lv'
    ];
    MysqlPool::getInstance($config)->init();
});

$http->on('request', function ($request, $response) {
    try {
        MysqlPool::getInstance()->printLenth(Swoole\Coroutine::getCid() . '获取前：');
        $mysql = MysqlPool::getInstance()->getConnection();
        MysqlPool::getInstance()->printLenth(Swoole\Coroutine::getCid() . '归还前：');
        $result = $mysql->query("select * from sunny_member");
        $row = $result->fetch(MYSQLI_ASSOC);
        MysqlPool::getInstance()->printLenth(Swoole\Coroutine::getCid() . '归还后：');
        $response->end($row['username']);
    } catch (\Exception $e) {
        $response->end($e->getMessage());
    }
});
$http->start();