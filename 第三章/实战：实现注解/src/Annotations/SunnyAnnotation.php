<?php

namespace Sunny\Annotations;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation()
 * @Target("ALL")
 */
class SunnyAnnotation
{
    private $name;

    public function __construct($value)
    {
        if (isset($value['name'])) {
            $this->name = $value['name'];
        } else {
            $this->name = $value;
        }
    }

    public function getName()
    {
        return $this->name;
    }
}