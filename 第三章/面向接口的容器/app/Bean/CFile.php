<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2019 http://www.sunnyos.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-08-28 01:50:52
 * | Author: Sunny (admin@mail.sunnyos.com) QQ：327388905
 * +----------------------------------------------------------------------
 */

namespace App\Bean;
use App\Bean\Interfaces\ICache;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Primary;

/**
 * @Bean()
 * @Primary()
 */
class CFile implements ICache
{

    public function set($key, $value)
    {
        echo "file:{$key}->{$value}\n";
    }
}
