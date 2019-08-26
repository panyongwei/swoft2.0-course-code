<?php

class Cache
{
    public function set($key, $value)
    {
        $cache = new CRedis();
        $cache->set($key, $value);
    }
}

class CRedis
{
    public function set($key, $value)
    {
        echo "redis:{$key}->{$value}\n";
    }
}

$cache = new Cache();
$cache->set("name","sunny");