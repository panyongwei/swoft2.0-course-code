<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2019 http://www.sunnyos.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-08-30 18:19:18
 * | Author: Sunny (admin@mail.sunnyos.com) QQ：327388905
 * +----------------------------------------------------------------------
 */

namespace App\Annotation\Parser;


use App\Annotation\Mapping\Sunny;
use Swoft\Annotation\Annotation\Mapping\AnnotationParser;
use Swoft\Annotation\Annotation\Parser\Parser;

/**
 * @AnnotationParser(Sunny::class)
 */
class SunnyParser extends Parser
{

    /**
     * Parse object
     *
     * @param int $type Class or Method or Property
     * @param object $annotationObject Annotation object
     *
     * @return array
     * Return empty array is nothing to do!
     * When class type return [$beanName, $className, $scope, $alias] is to inject bean
     * When property type return [$propertyValue, $isRef] is to reference value
     */
    public function parse(int $type, $annotationObject): array
    {
        //print_r([$type, $annotationObject]);
        echo $this->className."\n";
        return [];
    }
}
