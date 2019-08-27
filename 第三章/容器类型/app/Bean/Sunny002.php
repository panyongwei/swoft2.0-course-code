<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2019 http://www.sunnyos.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-08-28 01:24:47
 * | Author: Sunny (admin@mail.sunnyos.com) QQ：327388905
 * +----------------------------------------------------------------------
 */

namespace App\Bean;

use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean(scope=Bean::REQUEST)
 */
class Sunny002
{
    private $i = 0;

    public function __construct()
    {
        echo "sunny002 __construct\n";
    }

    public function getNum()
    {
        $this->i++;
        return "sunny002 Bean：" . $this->i . "\n";
    }
}
