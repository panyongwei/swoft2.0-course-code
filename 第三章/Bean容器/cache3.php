<?php

interface Icache
{
    public function set($key, $value);
}

class Cfile implements Icache
{
    public function set($key, $value)
    {
        echo "file:{$key}->{$value}\n";
    }
}


class CRedis implements Icache
{
    public function set($key, $value)
    {
        echo "redis:{$key}->{$value}\n";
    }
}

class Cache
{
    private $cache;

    public function __construct(Icache $cache)
    {
        $this->cache = $cache;
    }

    public function set($key, $value)
    {
        $this->cache->set($key, $value);
    }
}

$cache = new Cache(new CRedis());
$cache->set("name", "sunny");