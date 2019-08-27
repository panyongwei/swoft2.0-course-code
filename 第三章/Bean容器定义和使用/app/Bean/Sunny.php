<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2019 http://www.sunnyos.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-08-28 00:47:01
 * | Author: Sunny (admin@mail.sunnyos.com) QQ：327388905
 * +----------------------------------------------------------------------
 */

namespace App\Bean;

use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean(alias="sunny001")
 */
class Sunny
{
    private $i = 1;

    public function __construct()
    {
        echo "Sunny 构造方法\n";
    }

    public function setNum($i)
    {
        $this->i = $i;
    }

    public function getNum()
    {
        $pidMap = \Swoft::server()->getPidMap();
        echo $pidMap['workerId']."\n";
        return $this->i;
    }
}
