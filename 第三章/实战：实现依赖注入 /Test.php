<?php

class Test
{
    public $name;
    private $test1;

    public function __construct(Test1 $test1)
    {
        $this->test1 = $test1;
        $this->name = $this->test1->getName();
    }
}