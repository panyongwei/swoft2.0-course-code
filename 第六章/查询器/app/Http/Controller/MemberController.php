<?php

namespace App\Http\Controller;

use Swoft\Db\DB;
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
            'username' => time(),
            'passwd' => md5(time()),
        ];
        /*$d[] = $data;
        $data1 = [
            'username'=>time()+1,
            'passwd'=>md5(time()+1),
        ];
        $d[] = $data1;
        DB::table('member')->insert($d);*/
        //$id = DB::table('member')->insertGetId($data);
        //return context()->getResponse()->withContent("id:{$id}");
        //DB::table('member')->where('id',1)->update(['username'=>'sunny']);
        //DB::table('member')->where('id','>',3)->update(['username'=>'sunny']);
        DB::table('member')->delete(4);
    }

    /**
     * @RequestMapping(route="get")
     */
    public function get()
    {
//        $data = DB::table('member')->where('id','=','3')->get();
        //$data = DB::table('member')->where('id',3)->first();
        //$data = DB::table('member')->find(1);
        //$data = DB::selectOne("select * from sunny_member where id=?",[1]);
        //$data = DB::select("select * from sunny_member where id>? and username=?",[1,'sunny']);
        //$data = DB::table('member')->where('id',1)->value('passwd');
        //return context()->getResponse()->withContent($data);
        //$data = DB::table('member')->where('id',1)->where('id','=',3,'or')->toSql();
        $wheres = [
            ['id',1],
            ['username','like','%002%','or'],
            ['username','like','%003%','or'],
        ];
        $data = DB::table('member')->where($wheres)->get();
        return context()->getResponse()->withData($data);
    }

    /**
     * @RequestMapping(route="join")
     */
    public function join()
    {
        /*$data = DB::table('member')
            ->join('member_info', 'member.id', '=', 'member_info.user')
            ->get(['member.id','member.username','member_info.nickname']);*/
        $data = DB::table('member')
            ->join('member_info', 'member.id', '=', 'member_info.user')
            ->where('member.id',1)
            ->first(['member.id','member.username','member_info.nickname']);
        return context()->getResponse()->withData($data);
    }

}
