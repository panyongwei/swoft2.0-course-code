<?php

class Cache
{
    public function set($key, $value)
    {
        $cache = new Cfile();
        $cache->set($key, $value);
    }
}

class Cfile
{
    public function set($key, $value)
    {
        echo "file:{$key}->{$value}\n";
    }
}

$cache = new Cache();
$cache->set("name","sunny");