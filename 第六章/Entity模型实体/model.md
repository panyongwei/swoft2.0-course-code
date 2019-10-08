# 模型的使用

Swoft的模型就是实体 `Entity` ，一个实体的结构对应一张数据表的结构。每一个实体的实例就是对应数据库的一条记录，因此不能使用 `@Inject` 注入。

### 创建模型实体

```shell
php bin/swoft entity:c
```

通过命令生成，命令参数：

* --exclude STRING           Expect generate database table entity, alias is 'exc'
* --field_prefix STRING      别名 "fp"，去除字段前缀，如：`user_info` 使用参数 `--fp=user_` 生成的字段竟会变成 `info`
* --path STRING              生成实体存放路径，默认：@app/Model/Entity
* --pool STRING              选择数据库连接池，默认：db.pool
* --remove__prefix STRING     别名 "rp"，去除表前缀生存实体，如：`user_info` 表生成的文件是 UserInfo.php，使用参数 `--rp=user_` 生成是 Info.php
* --table STRING             选择要生成实体的数据表，--table=sunny_member,sunny_member_info 会生成两个指定表的实体
* --table_prefix STRING      别名 "tp"，生成实体去除表前缀如：`@Entity(table="sunny_member")` 去除后 `@Entity(table="member")`
* --td STRING                生成实体的模版，默认: @devtool/devtool/resource/template
* -y STRING                  自动确认类似linux安装命令的 -y

> 使用命令生成需要先安装 `devtool`

### 生成实体

```shell
php bin/swoft entity:c --remove_prefix=sunny_ --table=sunny_member,sunny_member_info -y
```

以上命令生成 `sunny_member` 和 `sunny_member_info` 两个表的实体，实体类去除表前缀，生成的实体就是 `Member.php` 和 `MemberInfo.php`。

### 实体注解

#### @Entity

声明一个类为实体类

* table 表名，如果 `app/bean.php` 没有指定 `prefix` 这里需要指定表前缀，如果指定这里不需要表前缀。
* pool 连接池，默认采用 `db.pool`

#### @Column

注解类成员属性对应数据库的字段。

* name 字段名
* prop 字段别名，只有在调用 `toArray()` 才会把别名用到数组里面隐藏数据库真实字段。如： `username` 设置 `prop="users"` 调用 `toArray()` 得到的数组就不会是 `username` 而是 `users`
* hidden 是否隐藏，设置为true的话，通过 `toArray()` 获取不了该字段，但是可以通过 get 获取，或者调用 `addVisible` 方法取消

#### @Id

主键id，加在对应数据库表的主键字段属性上，一个实体注解类只能有一个 `@id`

### 模型常用方法

#### 获取模型方法

方法|作用|参数
-|-|-|
__construct|new一个模型对象|array $attributes:设置参数到模型的数组
new|通过静态方法获取模型对象|array $attributes:设置参数到模型的数组
newInstance|获取模型对象|array $attributes:设置参数到模型的数组, bool $exists:设置模型数据是否存在数据库

#### 实例代码

```php
$member = new Member();
$member = Member::new();
$member = Member::newInstance();
```

#### 模型写入数据库方法

方法|作用|参数
-|-|-|
fill|把数据到参数设置到模型|array $attributes:设置参数到模型的数组
insert|批量数据入库，二维数组|array $values:要写入数据库的值
insertGetId|入库获取id|array $values:参数入库的数据, string $sequence:参考 PDO::lastInsertId
save|保存数据|保存模型数据到数据库

#### 示例代码

```php
$username = "sunny";
$passwd = md5("sunny123");
$data = [
    'username'=>$username,
    'passwd'=>$passwd
];

// 调用save()保存
$member = new Member();
$member->setUsername($username);
$member->setPasswd($passwd);
$res = $member->save();
// insert into `sunny_member` (`username`, `passwd`) values ('sunny', '7af4896825dfc7e94f8a1d6846a5a2d4')
var_dump($res);
var_dump($member->getId());

// 调用save()保存，在获取模型的时候填充数据
$member = Member::new($data);
$res = $member->save();
// insert into `sunny_member` (`username`, `passwd`) values ('sunny', '7af4896825dfc7e94f8a1d6846a5a2d4')
var_dump($res);
var_dump($member->getId());

// 调用save()保存，使用fill填充数据
$member = Member::new();
$member->fill($data);
$res = $member->save();
// insert into `sunny_member` (`username`, `passwd`) values ('sunny', '7af4896825dfc7e94f8a1d6846a5a2d4')
var_dump($res);
var_dump($member->getId());

// insertGetId() 保存获取写入数据库返回的id
$res = Member::insertGetId($data);
// insert into `sunny_member` (`username`, `passwd`) values ('sunny','7af4896825dfc7e94f8a1d6846a5a2d4')
var_dump($res);

$d = [
    ['username'=>'username1','passwd'=>$passwd],
    ['username'=>'username2','passwd'=>$passwd],
];
// 批量写入数据库
$res = Member::insert($d);
// insert into `sunny_member` (`passwd`, `username`) values ('username1', '7af4896825dfc7e94f8a1d6846a5a2d4'), ('username1', '7af4896825dfc7e94f8a1d6846a5a2d4')
var_dump($res);
```

#### 模型获取数据方法

方法|作用|参数
-|-|-|
all|获取全部记录|array $columns = ['*']:获取哪些字段
get|获取全部记录|array $columns = ['*']:获取哪些字段
find|根据ID获取一条记录|$id:查询id, array $columns = ['*']:查询哪些字段
chunkById|分块获取数据，数据量大可以节省内存|$count:获取条数,$callback:回调方法,$column:获取哪些字段,$alias:别名
cursor|使用迭代器游标获取数据，数据量大可节省空间|-

#### 示例代码

```php
// 获取所有数据，只获取id、username字段
Member::all(['id','username'])->toArray();
// select `id`, `username` from `sunny_member`

// 获取所有数据，只获取id、username字段
Member::get(['id','username'])->toArray();
// select `id`, `username` from `sunny_member`

// 根据逐渐id获取单条数据
Member::find(1)->toArray();
// select * from `sunny_member` where `sunny_member`.`id` = 1 limit 1

// 跟all和get相比，更节省内存
Member::chunkById(10,function($member){
    /** @var Member $m */
    foreach($member as $m){
        echo $m->getUsername()."\n";
    }
});
// 会执行多条SQL语句
// select * from `sunny_member` where `id` > ? order by `id` asc limit 1
// select * from `sunny_member` where `id` > ? order by `id` asc limit 1

// 跟all和get相比，更节省内存
/** @var Member $m */
foreach(Member::cursor() as $m){
    print_r($m->toArray());
}
```

#### 模型更新数据方法

方法|作用|参数
-|-|-|
update|更新数据，需要先查询出来|array $attributes:更新数据数组
updateOrCreate|检查第一个参数的数据是否在数据库，有就更新没有就创建|array $attributes:原数据源, array $values:更新数据数组
modifyById|根据id更新数据|int $id:主键ID, array $values:更新数据数组
modify|检查第一个参数的数据是否在数据库，有就更新没有就创建|array $attributes:原数据源, array $values:更新数据数组

#### 示例代码

```php
// 需要先查询出来再更新
$passwd = md5("sunny");
Member::find(1)->update(['passwd' => $passwd]);
// select * from `sunny_member` where `sunny_member`.`id` = 1 limit 1
// update `sunny_member` set `passwd` = '533c5ba8368075db8f6ef201546bd71a' where `id` = 1

// 查找 username 等于 sunny 的记录，替换成 sunnt007，如果记录存在会更新，不存在新增
Member::updateOrCreate(['username'=>'sunny'],['username'=>'sunnt007']);
// select * from `sunny_member` where (`username` = 'sunny') limit 1
// update `sunny_member` set `username` = 'sunnt007' where `id` = ?
或者
// insert into `sunny_member` (`username`) values ('sunnt007')

// 根据主键id更新数据
Member::modifyById(1,['username'=>'sunny001']);
// select * from `sunny_member` where `sunny_member`.`id` = 1 limit 1
// update `sunny_member` set `username` = 'sunny001' where `id` = 1

// 查找 username 等于 sunny001 的记录，替换成 002
Member::modify(['username'=>'sunny001'],['username'=>'002']);
// select * from `sunny_member` where (`username` = 'sunny001') limit 1
// update `sunny_member` set `username` = '002' where `id` = ?
```

#### 删除方法

方法|作用|参数
-|-|-|
delete|从数据库删除记录|-

```php
// 先执行find然后再delete
Member::find(1)->delete();
// select * from `sunny_member` where `sunny_member`.`id` = 1 limit 1
// delete from `sunny_member` where `id` = 1
```

#### 聚合查询方法

方法|作用|参数
-|-|-|
min|获取最小值|string $column:获取的字段
max|获取最大值|string $column:获取的字段
sum|获取字段总和|string $column:获取的字段
avg|获取字段平均值|string $column:获取的字段
count|统计条数|string $column:获取的字段

#### 示例代码

```php
Member::min('id');
// select min(`id`) as aggregate from `sunny_member`

Member::max('id');
// select max(`id`) as aggregate from `sunny_member`

Member::sum('id');
// select sum(`id`) as aggregate from `sunny_member`

Member::avg('id');
// select avg(`id`) as aggregate from `sunny_member`

Member::count('id');
// select count(`id`) as aggregate from `sunny_member`
```

#### 其他常用方法

方法|作用|参数
-|-|-|
increment|给某字段累加值|string $column:要增加值的字段；$amount:增加的数值
decrement|给某字段减少值|string $column:要增减少的字段；$amount:增加的数值
tableName|获取表名(static)|-
exists|判断数据存在数据库中|-
doesntExist|判断数据不存在数据库中|-
getTable|获取表名|-
getConnection|获取数据库连接|-
toJson|查询结果序列化成json|-
toArray|查询结果序列化成数组|-
paginate|分页|int $page:当前页数, int $perPage:每页条数, array $columns = ['*']:获取哪些字段
truncate|清空表|-

#### 示例代码

```php
// 让id为1的用户 views 加 1
Member::find(1)->increment('views',1);
// select * from `sunny_member` where `sunny_member`.`id` = 1 limit 1
// update `sunny_member` set `views` = `views` + 1 where `id` = 1

// 让id为1的用户 views 减 1
Member::find(1)->decrement('views',1);
// select * from `sunny_member` where `sunny_member`.`id` = 1 limit 1
// update `sunny_member` set `views` = `views` - 1 where `id` = 1

// 分页获取数据，第一个参数第一页数据，每页获取1条数据
$member = Member::paginate(1,1);
// select count(*) as aggregate from `sunny_member`
// select * from `sunny_member` limit 1 offset 0
```


这里这些是模型常用的方法，挑几个常用的记住就好了，在列出来的这些方法可以看到，进行不了多复杂的查询和操作。不可能这么不好用吧？其实模型兼容了查询器的所有方法，等下一节课我们学习了查询器再来做复杂的查询操作。以上列出来的方法均可配合查询器实现更复杂的查询，可以使用where、join等方法。
