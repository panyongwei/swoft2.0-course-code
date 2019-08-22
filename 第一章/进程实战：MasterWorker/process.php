<?php

class SunnyProcess
{
    // Master进程id
    protected static $masterPid;
    // Worker进程id集合
    protected static $workerPid = [];

    /**
     * 设置进程名称
     */
    public static function setProcessName($name)
    {
        if (extension_loaded("proctitle") && function_exists("setprotitle")) {
            @setprotitle($name);
        } elseif (version_compare(phpversion(), "5.5", "ge") && function_exists("cli_set_process_title")) {
            @cli_set_process_title($name);
        }
    }

    /**
     * 创建子进程
     * @param int $num
     */
    public static function forkWorker($num = 2)
    {
        for ($i = 0; $i < $num; $i++) {
            $pid = pcntl_fork();
            if ($pid > 0) {
                // 父进程，存储子进程的id
                static::$workerPid[$pid] = $pid;
            } elseif ($pid === 0) {
                static::setProcessName("Worker sunny");
                while (1) {
                    // 获取当前进程id
                    $pids = posix_getpid();
                    $time = microtime(true);
                    $masterpid = static::$masterPid;
                    echo "主进程：{$masterpid}，当前进程：{$pids}，当前时间：{$time}\n";
                    sleep(1);
                }
            } else {
                echo "进程创建失败\n";
            }
        }
    }

    /**
     * Master进程监控Worker进程
     */
    public static function monitor()
    {
        while (true) {
            // 挂起当前进程，直到有一个子进程退出或者接收到一个信号的时候执行
            $status = 0;
            $pid = pcntl_wait($status, WUNTRACED);
            echo $pid . "\n";
            pcntl_signal_dispatch();
            if ($pid >= 0) {
                unset(static::$workerPid[$pid]);
                echo "Worker 进程：{$pid}\n";
                static::forkWorker(1);
                print_r(static::$workerPid);
            }
        }
    }


    public static function runAll()
    {
        self::setProcessName("Master sunny");
        self::$masterPid = posix_getpid();
        self::forkWorker(2);
        self::monitor();
    }
}

SunnyProcess::runAll();