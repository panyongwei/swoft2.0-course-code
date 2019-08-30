<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2019 http://www.sunnyos.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-08-30 18:45:31
 * | Author: Sunny (admin@mail.sunnyos.com) QQ：327388905
 * +----------------------------------------------------------------------
 */

namespace App\Listener;


use Swoft\Event\Annotation\Mapping\Subscriber;
use Swoft\Event\EventInterface;
use Swoft\Event\EventSubscriberInterface;
use Swoft\Event\Listener\ListenerPriority;
use Swoft\Server\SwooleEvent;

/**
 * @Subscriber()
 */
class WorkerSubscripberListener implements EventSubscriberInterface
{

    public function handler(EventInterface $event)
    {
        echo "WorkerSubscripberListener 监听到worker进程\n";
    }

    public function sunnyTask(EventInterface $event)
    {
        echo "WorkerSubscripberListener 监听到sunnyTask\n";
    }

    /**
     * Configure events and corresponding processing methods (you can configure the priority)
     *
     * @return array
     * [
     *  'event name' => 'handler method'
     *  'event name' => ['handler method', priority]
     * ]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            SwooleEvent::WORKER_START => ['handler'],
            'sunny.task'=>['sunnyTask',ListenerPriority::HIGH]
        ];
    }
}
