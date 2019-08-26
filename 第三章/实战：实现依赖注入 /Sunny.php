<?php
require_once "./Container.php";
require_once "./Test.php";
require_once "./Test1.php";

class Sunny
{
    private $test;

    public function __construct(Test $test)
    {
        $this->test = $test;
    }

    public function getName()
    {
        echo "获取test里面的name：{$this->test->name}\n";
    }
}

$app = Container::getInstance();
$sunny = $app->get(Sunny::class);
$sunny->getName();