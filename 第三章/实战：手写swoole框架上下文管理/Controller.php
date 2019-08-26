<?php

class Controller
{
    public function index()
    {
        $num = Context::get('num');
        $num++;
        return "index:$num\n";
    }

    public function test()
    {
        $num = Context::get('num');
        $num++;
        return "test:$num\n";
    }
}