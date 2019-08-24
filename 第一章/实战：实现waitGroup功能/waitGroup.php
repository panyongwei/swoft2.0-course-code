<?php

use Swoole\Coroutine\Channel;

class WaitGroup
{
    private $count;
    private $chan;

    public function __construct()
    {
        $this->chan = new Channel();
    }

    public function add()
    {
        $this->count++;
    }

    public function done()
    {
        $this->chan->push(true);
    }

    public function wait()
    {
        for ($i = 0; $i < $this->count; $i++) {
            $this->chan->pop();
        }
    }
}