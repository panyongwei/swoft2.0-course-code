# 查询器

Swoft的查询器功能很强大，高度兼容 `Laravel`。前面我们学习了如何通过模型实体操作数据库，但是单靠实体只能实现简单的操作，想要实现更复杂的SQL语句可以搭配查询器使用。

使用查询器需要注意在 `app/bean.php` 配置数据库连接的时候一定要配置 `prefix` 参数，不然在使用 `DB::table()` 需要写上表前缀。

### 查询器常用方法

#### 写入数据库方法

方法|作用|参数
-|-|-|
insert|写入一条数据到数据库|array $values:入库数据数组
insertGetId|写入一条数据到数据库并返回id|array $values:入库数据数组


##### 示例代码

```php
$data = [[
    'username' => 'sunny003',
    'passwd' => md5('sunny001')
],[
    'username' => 'sunny004',
    'passwd' => md5('sunny001')
]];
// 可以写入多条数据
$id = DB::table('member')->insert($data);
// insert into `sunny_member` (`passwd`, `username`) values ('sunny003', '043d3e9f6a78b368f7a19ed82de076e0'), ('sunny004', '043d3e9f6a78b368f7a19ed82de076e0')

$data = [
    'username'=>'sunny002',
    'passwd'=>md5('sunny001')
];
// 写入单条数据
DB::table('member')->insert($data);
// insert into `sunny_member` (`username`, `passwd`) values ('sunny002', '043d3e9f6a78b368f7a19ed82de076e0')

// 写入单条数据并获取id
$id = DB::table('member')->insertGetId($data);
// insert into `sunny_member` (`username`, `passwd`) values ('sunny002', '043d3e9f6a78b368f7a19ed82de076e0')
var_dump($id);
```

#### 更新数据方法

方法|作用|参数
-|-|-|
update|更新数据到数据库，可搭配where方法使用，返回更新数据条数|array $values:更新数据数组

```php
$id = 2;
$data = [
    'username'=>'sunnytest001'
];
$res = DB::table('member')->where('id',$id)->update($data);
// update `sunny_member` set `username` = 'sunnytest001' where `id` = 2
```

#### 删除数据方法

方法|作用|参数
-|-|-|
delete|从数据库删除一条记录，可搭配where方法使用，返回删除条数|int $id:主键id

```php
$id = 1;
DB::table('member')->delete($id);
// delete from `sunny_member` where `sunny_member`.`id` = 1

DB::table('member')->where('id','>',$id)->delete();
// delete from `sunny_member` where `id` > 1
```

#### 查询方法
方法|作用|参数
-|-|-|
get|获取全部数据|array $column:查询的字段
first|获取单条记录|array $column:查询的字段
find|根据主键ID获取单挑记录|string $id:主键ID,array $columns = ['*']:查询的字段
select|直接执行sql语句|string $query:SQL语句, $bindings = []:SQL语句的参数, $useReadPdo:是否从读库读，配置读写分离读时候会从读库取
selectOne|直接执行sql语句，获取单条数据|string $query:SQL语句, $bindings = []:SQL语句的参数, $useReadPdo:是否从读库读，配置读写分离读时候会从读库取
cursor|对数据库运行select语句并返回生成器|string $query:SQL语句, $bindings = []:SQL语句的参数, $useReadPdo:是否从读库读，配置读写分离读时候会从读库取
value|获取单个字段的值|string $column|查询的字段


```php
DB::table('member')->get();
// select * from `sunny_member`

DB::table('member')->first();
// select `id` from `sunny_member` limit 1

DB::table('member')->find(1);
// select * from `sunny_member` where `id` = 1 limit 1

DB::selectOne("select * from sunny_member where id=?",[1]);
// select * from sunny_member where id=1

DB::select("select * from sunny_member where id=?",[1]);
// select * from sunny_member where id=1

$res = DB::table('member')->where('id',18)->value('username');
// select `username` from `sunny_member` where `id` = 18 limit 1
```

#### 连表方法

#### 公共参数

* $table 关联的表名
* $first 主表的关联字段
* $operator 条件 =、<、>、<>、!=等等
* $type 连接类型，默认为 `inner`
* $where 采用 where 还是 on 拼接条件，默认为false采用on

方法|作用|参数
-|-|-|
join|连表查询|$table,$first,$operator,$second,$type,$where
leftJoin|左表为主表|$table,$first,$operator,$second；$type 默认为 `left`
rightJoin|右表为主表|$table,$first,$operator,$second；$type 默认为 `right`


#### 示例代码

```php
DB::table('member')
    ->join('member_info','member.id','=','member_info.user','left',true)
    ->get('member.*,member_info.nickname')->toArray();
// select `sunny_member`.*, `sunny_member_info`.`nickname` from `sunny_member` inner join `sunny_member_info` on `sunny_member`.`id` = `sunny_member_info`.`user`    

DB::table('member')
    ->leftjoin('member_info','member.id','=','member_info.user')
    ->get(['member.*','member_info.nickname'])->toArray();
// select `sunny_member`.*, `sunny_member_info`.`nickname` from `sunny_member` left join `sunny_member_info` on `sunny_member`.`id` = `sunny_member_info`.`user`

DB::table('member')
    ->rightjoin('member_info','member.id','=','member_info.user')
    ->get(['member.*','member_info.nickname'])->toArray();
// select `sunny_member`.*, `sunny_member_info`.`nickname` from `sunny_member` right join `sunny_member_info` on `sunny_member`.`id` = `sunny_member_info`.`user`
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
DB::table("member")->min('id');
// select min(`id`) as aggregate from `sunny_member`

DB::table("member")->max('id');
// select max(`id`) as aggregate from `sunny_member`

DB::table("member")->sum('id');
// select sum(`id`) as aggregate from `sunny_member`

DB::table("member")->avg('id');
// select avg(`id`) as aggregate from `sunny_member`

DB::table("member")->count('id');
// select count(`id`) as aggregate from `sunny_member`
```

#### 其他公共方法

方法|作用|参数
-|-|-|
select|查询的时候筛选字段|string ...$columns 为多个参数，多个字段用英文逗号 "," 隔开
where|设置查询条件|$column:条件字段, $operator:或者条件值, $value:条件值, string $boolean = 'and':逻辑条件
whereBetween|使用MySQL between|string $column:条件字段,array $values:区间值，如[10,12],string $boolean:逻辑条件，默认and
whereRaw|原生的SQL表达式|$sql:SQL语句表达式, array $bindings:表达式的参数值,$boolean = 'and':逻辑条件
whereIn|SQL语句 in 查询|$column:条件字段, $values:条件参数，$boolean:逻辑条件，默认and，bool $not:false为In，true为NotIn
distinct|MySQL去重，配合 selectRaw 使用|-
selectRaw|添加原生表达式到查询语句|string $expression:表达式, array $bindings:表达式的参数值
orderBy|排序|string $column:排序字段, string $direction:desc 或 asc
query|选择连接池|string $name:连接池名称
paginate|分页|int $page:当前页码, int $perPage:每页条数, array $columns|查询字段
inRandomOrder|随机获取一条数据|-
doesntExist|判断数据不存在数据库|-
exists|判断数据存在数据库|-
toSql|获取SQL语句|-
offset|跳过几条|int $value:跳过的条数
limit|获取条数|int $value:获取的条数
groupBy|分组查询|...$groups:分组查询字段，可传多个字段
having|聚合分组指定过滤器条件|$column:过滤字段, $operator:条件或者条件值, $value:条件值, $boolean = 'and':逻辑条件
db|切换数据库|string $dbname:数据库名称

```php
$res = DB::table('member')->select('id','username','views')->get();
// select `id`, `username`, `views` from `sunny_member`

$res = DB::table('member')->where('id',1)->first();
// select * from `sunny_member` where `id` = 1 limit 1

$res = DB::table('member')->where('id','>',1)->first();
// select * from `sunny_member` where `id` > 1 limit 1

$res = DB::table('member')->where('id',1)->where('id','=',2,'or')->first();
// select * from `sunny_member` where `id` = 1 or `id` = ? limit 1

$wheres = [
    ['id',18],
    ['username','like','%002%'],
    ['username','like','%004%','or'],
];
$res = DB::table('member')->where($wheres)->get();
// select * from `sunny_member` where (`id` = 18 or `username` like '%002%' or `username` like '%004%')

$res = DB::table('member')->whereBetween('id',[1,18])->get();
// select * from `sunny_member` where `id` between 1 and 18

$res = DB::table("member")->where('id',1)->orWhere('id',18)->get();
// select * from `sunny_member` where `id` = 1 or `id` = 18

$res = DB::table("member")->whereRaw('id>?',[1])->get();
// select * from `sunny_member` where id>1

$in = [1,3];
$res = DB::table("member")->whereIn('id',$in)->get();
// select * from `sunny_member` where `id` in (1, 3)

DB::table('member')->distinct()->selectRaw('id')->get();
// select distinct id from `sunny_member`

DB::table('member')->selectRaw('(select `nickname` from `sunny_member_info` where `user`=?) as c',[2])->first();
// select (select `nickname` from `sunny_member_info` where `user`=2) as c from `sunny_member` limit 1

$res = DB::table("member")->inRandomOrder()->first();
// select * from `sunny_member` order by RAND() limit 1

$res = DB::table("order")->groupBy('member')->get();
// select * from `sunny_order` group by `member`

$res = DB::table("order")->groupBy('member')->selectRaw("*,sum(order_price) as op")->having('op','>',300000)->get();
// select *,sum(order_price) as op from `sunny_order` group by `member` having `op` > 300000
```

#### 日期方法

##### 公共参数

* booleancolumn 要查询的字段
* $operator 条件 =、<、>、<>、!=等等
* $value 查询的条件值
* $boolean 逻辑条件

> 如果 `$operator` 传递 `$value` 的参数，那么 `$operator` 则会默认为 `=` 

方法|作用|参数
-|-|-|
whereDate|按照日期查询|$column, $operator, $value, string $boolean = 'and'
whereYear|按照年份查询|$column, $operator, $value, string $boolean = 'and'
whereMonth|按照月份查询|$column, $operator, $value, string $boolean = 'and'
whereDay|按照天查询|$column, $operator, $value, string $boolean = 'and'

#### 数据库锁

方法|作用|参数
-|-|-|
sharedLock|共享锁|-
lockForUpdate|排他锁|-