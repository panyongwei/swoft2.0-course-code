<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2019 http://www.sunnyos.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-08-28 01:22:54
 * | Author: Sunny (admin@mail.sunnyos.com) QQ：327388905
 * +----------------------------------------------------------------------
 */

namespace App\Bean;

use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean(scope=Bean::PROTOTYPE)
 */
class Sunny001
{
    private $i = 0;

    public function __construct()
    {
        echo "sunny001 __construct\n";
    }

    public function getNum()
    {
        $this->i++;
        return "sunny001 Bean：" . $this->i . "\n";
    }
}
