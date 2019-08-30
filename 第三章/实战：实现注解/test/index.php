<?php

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Sunny\Test;

$load = require dirname(__DIR__) . "/vendor/autoload.php";
AnnotationRegistry::registerLoader([$load, 'loadClass']);
$annotationReader = new AnnotationReader();
$reflectionClass = new ReflectionClass(Test::class);
$classAnnotations = $annotationReader->getClassAnnotations($reflectionClass);
foreach ($classAnnotations as $classAnnotation){
    echo $classAnnotation->getName()."\n";
}