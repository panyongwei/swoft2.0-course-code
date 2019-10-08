# 模型事件

当使用模型操作的时候会触发一些时间，我们可以根据不同的时间进行数据的处理。比如想要实时更新数据到 ElasticSearch 可以监听 `swoft.model.saved` 事件进行添加，监听 `swoft.model.updated` 更新，又或者要实时更新缓存，也可以使用这个办法。

公共的事件名列表, 可以在`Swoft\Db\DbEvent` 类中参看所有事件

Event  | Params | Description
------------- | ------------- | -------------
`swoft.db.transaction.begin`  | 没有参数 | 事务启动。
`swoft.db.transaction.commit`  | 没有参数 | 事务提交。
`swoft.db.transaction.rollback`  | 没有参数 | 事务回滚。
`swoft.model.saving`  | target 是具体操作实体类 | 所有实体保存中事件。
`swoft.model.saved`  | target 是具体操作实体类 | 所有实体保存后事件。
`swoft.model.updating`  | target 是具体操作实体类 | 所有实体更新前事件。
`swoft.model.updated`  | target 是具体操作实体类 | 所有实体更新后事件。
`swoft.model.creating`  | target 是具体操作实体类 | 所有实体创建前事件。
`swoft.model.created`  | target 是具体操作实体类 | 所有实体创建后事件。
`swoft.model.deleting`  | target 是具体操作实体类 | 所有实体删除前事件。
`swoft.model.deleted`  | target 是具体操作实体类 | 所有实体后删除前事件。
`swoft.db.ran`  | target 是连接对象,参数 1=未预处理 sql ,参数 2=绑定的参数 | 所有 sql 执行后的事件,事件返回的连接已返回给连接池只能获取它的配置信息。
`swoft.db.affectingStatementing`  | target 是连接对象,参数 1=正在处理的` PDO statement` ,参数 2=绑定的参数 | 正在执行 `update` 和`delete`动作
`swoft.db.selecting`  | target 是连接对象,参数 1=正在处理的` PDO statement` ,参数 2=绑定的参数  | 正在执行查询动作。

> 如果是`正在进行时(ing)` 在监听事件中是调用了 `$event->stopPropagation(true);` 后续操作会终止直接返回结果. 对`过去式`停止无效

### 创建模型事件监听器

创建模型使劲监听器跟创建其他事件监听器一样，都是放在 `app/Listener` 目录，也是实现 `EventHandlerInterface` 接口。

```php
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
```

我们在学习事件的时候有学过这个，就是发送事件的时候传递的第二个参数，我们在讲事件的时候没有详细学习这个参数。

```php
$model = $event->getTarget();
```

我们可以看到在模型事件里面，这个参数用来传递了模型对象。

```php
Member::find(1)->update(['username'=>'2122']);
```

更新之后触发事件