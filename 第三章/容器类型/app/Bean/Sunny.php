<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2019 http://www.sunnyos.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-08-28 01:21:10
 * | Author: Sunny (admin@mail.sunnyos.com) QQ：327388905
 * +----------------------------------------------------------------------
 */

namespace App\Bean;
use Swoft\Bean\Annotation\Mapping\Bean;
/**
 * @Bean(scope=Bean::SINGLETON)
 */
class Sunny
{
    private $i = 0;
    public function __construct()
    {
        echo "sunny __construct\n";
    }
    public function getNum()
    {
        $this->i++;
        return "sunny Bean：".$this->i."\n";
    }
}
