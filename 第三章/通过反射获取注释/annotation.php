<?php
/**
 * @Sunny()
 */
class annotation
{
}
$re = new ReflectionClass(annotation::class);
print_r($re->getDocComment());