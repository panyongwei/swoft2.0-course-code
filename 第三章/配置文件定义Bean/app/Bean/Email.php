<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2019 http://www.sunnyos.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-08-28 01:04:27
 * | Author: Sunny (admin@mail.sunnyos.com) QQ：327388905
 * +----------------------------------------------------------------------
 */

namespace App\Bean;
use Swoft\Bean\Annotation\Mapping\Bean;
/**
 * @Bean()
 */
class Email
{
    public function send(){
        echo "email send\n";
    }
}
