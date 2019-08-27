<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2019 http://www.sunnyos.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-08-28 01:04:38
 * | Author: Sunny (admin@mail.sunnyos.com) QQ：327388905
 * +----------------------------------------------------------------------
 */

namespace App\Bean;
use Swoft\Bean\Annotation\Mapping\Bean;
/**
 * @Bean()
 */
class Sms
{
    public function send(){
        echo "sms send\n";
    }
}
