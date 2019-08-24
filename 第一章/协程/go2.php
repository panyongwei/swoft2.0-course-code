<?php
Swoole\Runtime::enableCoroutine(true);
go(function () {
    echo "1-start\n";
    sleep(1);
    echo "1-end\n";
});

go(function () {
    echo "2-start\n";
    sleep(1);
    echo "2-end\n";
});

go(function () {
    echo "3-start\n";
    sleep(1);
    echo "3-end\n";
});

go(function () {
    echo "4-start\n";
    sleep(1);
    echo "4-end\n";
});
echo "main\n";
