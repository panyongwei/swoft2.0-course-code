<?php

use App\Bean\Email;
use App\Bean\Sms;
use App\Bean\SunnySms;
use Swoft\Db\Database;
use Swoft\Http\Server\HttpServer;
use Swoft\Http\Server\Swoole\RequestListener;
use Swoft\Redis\RedisDb;
use Swoft\Rpc\Client\Client as ServiceClient;
use Swoft\Rpc\Client\Pool as ServicePool;
use Swoft\Rpc\Server\ServiceServer;
use Swoft\Server\SwooleEvent;
use Swoft\Task\Swoole\FinishListener;
use Swoft\Task\Swoole\TaskListener;
use Swoft\WebSocket\Server\WebSocketServer;

return [
    'config' => [
        'path' => __DIR__ . '/../config',
        'env' => 'pro'
    ],
    'logger' => [
        'flushRequest' => false,
        'enable' => false,
        'json' => false,
    ],
    'httpServer' => [
        'class' => HttpServer::class,
        'port' => 18306,
        'listener' => [
            'rpc' => bean('rpcServer')
        ],
        'process' => [
//            'monitor' => bean(MonitorProcess::class)
//            'crontab' => bean(CrontabProcess::class)
        ],
        'on' => [
//            SwooleEvent::TASK   => bean(SyncTaskListener::class),  // Enable sync task
            SwooleEvent::TASK => bean(TaskListener::class),  // Enable task must task and finish event
            SwooleEvent::FINISH => bean(FinishListener::class)
        ],
        /* @see HttpServer::$setting */
        'setting' => [
            'worker_num' => 4,
            'task_worker_num' => 12,
            'task_enable_coroutine' => true
        ]
    ],
    'httpDispatcher' => [
        // Add global http middleware
        'middlewares' => [
            \Swoft\View\Middleware\ViewMiddleware::class,
        ],
        'afterMiddlewares' => [
            \Swoft\Http\Server\Middleware\ValidatorMiddleware::class
        ]
    ],
    'db' => [
        'class' => Database::class,
        'dsn' => config('db.dsn'),
        'username' => config('db.username'),
        'password' => config('db.password')
    ],
    'db.pool'=>[
        'minActive'=>30,
        'maxActive'=>50
    ],
    'migrationManager' => [
        'migrationPath' => '@app/Migration',
    ],
    'redis' => [
        'class' => RedisDb::class,
        'host' => '127.0.0.1',
        'port' => 6379,
        'database' => 0,
        'option' => [
            'prefix' => ''
        ]
    ],
    'redis.pool' => [
        'class' => \Swoft\Redis\Pool::class,
        'redisDb' => bean('redis'),
        'minActive' => 30,
        'maxActive' => 50,
        'maxWait' => 0,
        'maxWaitTime' => 0,
        'maxIdleTime' => 60,
    ],
    'user' => [
        'class' => ServiceClient::class,
        'host' => '127.0.0.1',
        'port' => 18307,
        'setting' => [
            'timeout' => 0.5,
            'connect_timeout' => 1.0,
            'write_timeout' => 10.0,
            'read_timeout' => 0.5,
        ],
        'packet' => bean('rpcClientPacket')
    ],
    'user.pool' => [
        'class' => ServicePool::class,
        'client' => bean('user')
    ],
    'rpcServer' => [
        'class' => ServiceServer::class,
    ],
    'wsServer' => [
        'class' => WebSocketServer::class,
        'port' => 18308,
        'on' => [
            // Enable http handle
            SwooleEvent::REQUEST => bean(RequestListener::class),
        ],
        'debug' => 1,
        // 'debug'   => env('SWOFT_DEBUG', 0),
        /* @see WebSocketServer::$setting */
        'setting' => [
            'log_file' => alias('@runtime/swoole.log'),
        ],
    ],
    'tcpServer' => [
        'port' => 18309,
        'debug' => 1,
    ],
    /** @see \Swoft\Tcp\Protocol */
    'tcpServerProtocol' => [
        // 'type'            => \Swoft\Tcp\Packer\JsonPacker::TYPE,
        'type' => \Swoft\Tcp\Packer\SimpleTokenPacker::TYPE,
        // 'openLengthCheck' => true,
    ],
    'cliRouter' => [
        // 'disabledGroups' => ['demo', 'test'],
    ],
    /*'testSunnyTest' => [
        'class' => SunnySms::class,
        [\bean(Email::class), 10000],
        'sms' => \bean(Sms::class),
        'name' => 'My name is sunny',
        '__option' => [
            'alias' => 'testSunnyTest01'
        ]
    ]*/
];
