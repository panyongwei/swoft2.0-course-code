<?php
Swoole\Runtime::enableCoroutine(true);
$chan = new Swoole\Coroutine\Channel();
// 模拟生产者
go(function () use ($chan) {
    echo "数据生成中....\n";
    sleep(1);
    $chan->push(['name' => 'sunny']);
    echo "数据生成完成....\n";
});

// 模拟消费者
go(function () use ($chan) {
    echo "等待消费....\n";
    $data = $chan->pop();
    print_r($data);
    echo "消费完成\n";
});
echo "main\n";