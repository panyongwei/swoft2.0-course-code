<?php

use Swoole\Coroutine\Channel;

/**
 * 1、设置配置信息
 * 2、创建连接对象
 * 3、获取连接对象
 * 4、获取连接对象，空闲连接不够创建到最大连接数
 * 5、执行sql语句
 * 6、归还连接
 */
class MysqlPool
{
    private $min;
    private $max;
    private $count;
    private $timeOut = 0.2;
    private $connections;
    private $config = [];
    private static $instance;

    private function __construct($config)
    {
        $this->config = $config;
        $this->min = $this->config['min'] ?? 2;
        $this->max = $this->config['max'] ?? 4;
        $this->timeOut = $this->config['time_out'] ?? 0.2;
        $this->connections = new Channel($this->max);
    }

    /**
     * 单例模式获取MysqlPool对象
     * @param null $config
     * @return MysqlPool
     * @throws Exception
     */
    public static function getInstance($config = null)
    {
        if (empty(self::$instance)) {
            if (empty($config)) {
                throw new Exception("请传递配置信息");
            }
            self::$instance = new static($config);
        }
        return self::$instance;
    }

    /**
     * 初始化MySQL连接池
     */
    public function init()
    {
        for ($i = 0; $i < $this->min; $i++) {
            $this->count++;
            $mysql = $this->createDb();
            $this->connections->push($mysql);
        }
    }

    /**
     * 创建PDO数据库连接
     */
    private function createDb()
    {
        $dsn = "mysql:dbname={$this->config['database']};host={$this->config['db_host']}";
        try {
            $mysql = new PDO($dsn, $this->config['db_user'], $this->config['db_passwd']);
            return $mysql;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }


    public function getConnection()
    {
        $mysql = null;
        if ($this->connections->isEmpty()) {
            if ($this->count < $this->max) {
                $this->count++;
                $mysql = $this->createDb();
            } else {
                $mysql = $this->connections->pop($this->timeOut);
            }
        } else {
            $mysql = $this->connections->pop($this->timeOut);
        }
        if (!$mysql) {
            throw new \Exception("没有连接了");
        }
        defer(function () use ($mysql) {
            $this->connections->push($mysql);
        });
        return $mysql;
    }

    /**
     * 调试打印连接池的容量，非主要代码
     * @param $str
     */
    public function printLenth($str)
    {
        echo $str . $this->connections->length() . "\n";
    }

}