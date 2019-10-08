<?php

namespace App\Http\Controller;

use App\Model\Entity\Member;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;

/**
 * @Controller()
 */
class MemberController
{
    /**
     * @RequestMapping(route="add")
     */
    public function add()
    {
        $data = [
            'username' => 'sunny' . time(),
            'passwd' => md5(time()),
        ];
        //$member = new Member();
        //$member->fill($data);
        //$member = Member::new($data);
        //$member->save();
        // insert into `sunny_member` (`username`, `passwd`) values ('sunny', '7af4896825dfc7e94f8a1d6846a5a2d4')

        //Member::insert($data);
        //$id = Member::insertGetId($data);
        //var_dump($id);

        $data['username'] = 10;
        $d[] = $data;
        $data['username'] = 20;
        $d[] = $data;
        Member::insert($d);
    }

    /**
     * @RequestMapping(route="get")
     */
    public function get()
    {
        //print_r(Member::all(['id','username','passwd'])->toArray());
        //print_r(Member::get(['id','username','passwd'])->toArray());
        //print_r(Member::find(2,['id','username'])->toArray());
        /*Member::chunkById(1,function ($members){
            foreach ($members as $m){
                print_r($m->toArray());
            }
        });*/
        foreach (Member::cursor() as $m) {
            print_r($m->toArray());
        }
    }

    /**
     * @RequestMapping(route="up")
     */
    public function up()
    {
        //Member::find(5)->update(['username'=>'sunny5']);
        //Member::updateOrCreate(['username'=>10000],['username'=>'sunny10000']);
        //Member::modify(['username'=>10000],['username'=>'sunny10000']);
        Member::modifyById(8, ['passwd' => md5(time())]);
    }

    /**
     * @RequestMapping(route="test")
     */
    public function test()
    {
        $min = Member::min('id');
        echo "min:{$min}\n";

        $max = Member::max('id');
        echo "max:{$max}\n";

        $sum = Member::sum('id');
        echo "sum:{$sum}\n";

        $avg = Member::avg('id');
        echo "avg:{$avg}\n";

        $count = Member::count('id');
        echo "count:{$count}\n";

        //Member::find(1)->increment('views');
        //Member::find(1)->decrement('views');
        $page = Member::paginate(2, 2, ['id', 'username']);
        print_r($page);
        Member::find(8)->delete();
    }

    /**
     * @RequestMapping(route="event")
     */
    public function event()
    {
        Member::find(7)->update(['passwd'=>time()]);
    }
}
