<?php
/**
 * 1、设置配置信息
 * 2、创建连接对象
 * 3、获取连接对象
 * 4、获取连接对象，空闲连接不够创建到最大连接数
 * 5、执行sql语句
 * 6、归还连接
 */
use Swoole\Coroutine\Channel;

class MysqlPool
{
    // 最小连接数
    private $min;
    // 最大连接数
    private $max;
    // 当前连接数
    private $count = 0;
    // 获取超时时间
    private $timeOut = 0.2;
    // 连接池对象容器
    private $connections;
    // 配置信息
    private $config = [];
    // 连接池对象
    private static $instance;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->min = $this->config['min'] ?? 2;
        $this->max = $this->config['max'] ?? 4;
        $this->timeOut = $this->config['time_out'] ?? 0.2;
        $this->connections = new Channel($this->max);
    }

    /**
     * 获取连接池对象
     * @param null $config
     * @return MysqlPool
     */
    public static function getInstance($config = null)
    {
        if (empty(self::$instance)) {
            if (empty($config)) {
                throw new RuntimeException("mysql config empty");
            }
            self::$instance = new static($config);
        }

        return self::$instance;
    }

    /**
     * 初始化连接池
     * @throws Exception
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
     * 创建数据库连接对象
     * @return PDO
     * @throws Exception
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

    /**
     * 获取数据库连接
     * @return mixed|null|PDO
     * @throws Exception
     */
    public function getConnection()
    {
        $mysql = null;
        // 判断是否为空，如果池空了，判断当前连接数是否下于最大连接数
        // 如果小于最大连接数创建新连接数
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
        // 获取不到数据库连接抛出异常
        if (!$mysql) {
            throw new \Exception('没有连接了');
        }
        // 当协程结束之后归还连接池
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