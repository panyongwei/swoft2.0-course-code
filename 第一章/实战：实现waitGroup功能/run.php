<?php
Swoole\Runtime::enableCoroutine(true);
include 'waitGroup.php';
echo "start\n";
$t = microtime(true);
go(function () use ($t) {
    $wg = new WaitGroup();
    go(function () use ($t, &$wg) {
        $wg->add();
        echo file_get_contents("http://192.168.1.175/swoole.php");
        echo "协程1：" . (microtime(true) - $t) . "\n";
        $wg->done();
    });

    go(function () use ($t, &$wg) {
        $wg->add();
        echo file_get_contents("http://192.168.1.175/swoole.php");
        echo "协程2：" . (microtime(true) - $t) . "\n";
        $wg->done();
    });

    go(function () use ($t, &$wg) {
        $wg->add();
        echo file_get_contents("http://192.168.1.175/swoole.php");
        echo "协程3：" . (microtime(true) - $t) . "\n";
        $wg->done();
    });
    $wg->wait();
    echo "全部协程执行完毕：" . (microtime(true) - $t) . "\n";
});
echo "end\n";
echo (microtime(true) - $t) . "\n";