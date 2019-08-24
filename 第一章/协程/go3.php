<?php
Swoole\Runtime::enableCoroutine(true);

go(function () {
    sleep(2);
    echo "go1\n";
});

go(function () {
    sleep(1);
    echo "go2\n";
});
echo "main\n";