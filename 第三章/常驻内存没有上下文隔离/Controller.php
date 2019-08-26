<?php

class Controller extends BaseController
{
    public function index()
    {
        $this->num++;
        return "index:{$this->num}\n";
    }

    public function test()
    {
        $this->num++;
        return "test:{$this->num}\n";
    }
}