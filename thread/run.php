<?php
require_once "cc.php";
require_once "threadPool.php";
$count = 2000;
$pool = new ThreadPool('http://154.8.165.222/', $count);
for ($i = 0; $i < $count; $i++) {
    $pool->push();
}
$pool->start();
$pool->join();