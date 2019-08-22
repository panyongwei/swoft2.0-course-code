<?php

class ThreadPool
{
    private $pool = [];
    private $url;
    private $count;

    public function __construct($url, $count)
    {
        $this->url = $url;
        $this->count = $count;
    }

    public function push()
    {
        if (count($this->pool) < $this->count) {
            $this->pool[] = new CC($this->url);
            return true;
        } else {
            return false;
        }
    }

    public function start()
    {
        foreach ($this->pool as $id => $worker) {
            $this->pool[$id]->start();
        }
    }

    public function join()
    {
        foreach ($this->pool as $id => $worker) {
            $this->pool[$id]->join();
        }
    }
}