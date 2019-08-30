<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2019 http://www.sunnyos.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-08-30 18:19:13
 * | Author: Sunny (admin@mail.sunnyos.com) QQ：327388905
 * +----------------------------------------------------------------------
 */

namespace App\Annotation\Mapping;


use Doctrine\Common\Annotations\Annotation\Attribute;
use Doctrine\Common\Annotations\Annotation\Attributes;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation()
 * @Target("ALL")
 * @Attributes({
 *      @Attribute("name",type="string")
 * })
 */
class Sunny
{
    private $name;

    public function __construct(array $values)
    {
        if (isset($values['value'])) {
            $this->name = $values['value'];
        }
        if (isset($values['name'])) {
            $this->name = $values['name'];
        }
        echo "-----------------Sunny-----------------\n";
        print_r($values);
        echo "-----------------Sunny-----------------\n";
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

}
