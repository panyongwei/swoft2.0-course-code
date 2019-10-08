<?php

namespace App\Listener;

use App\Model\Entity\Member;
use Swoft\Db\DbEvent;
use Swoft\Db\Eloquent\Model;
use Swoft\Event\Annotation\Mapping\Listener;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;

/**
 * @Listener(DbEvent::MODEL_UPDATED)
 */
class MemberListener implements EventHandlerInterface
{

    /**
     * @param EventInterface $event
     */
    public function handle(EventInterface $event): void
    {
        /** @var Model $model */
        $model = $event->getTarget();
        // 判断当前事件发生的对象是否是Member实体类
        if ($model instanceof Member) {
            // 获取修改之前的内容
            print_r($model->getModelOriginal());
            // 获取修改的内容
            print_r($model->getModelChanges());
        }
    }
}
