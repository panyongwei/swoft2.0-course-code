<?php

use Swoole\Coroutine;

class Context
{
    /**
     * $context = [
     *      1=>[
     *          $key=>$context
     * ]
     * ];
     */
    private static $context = [];

    public static function get($key = null)
    {
        $tid = Coroutine::getCid();
        if ($key == null) {
            return self::$context[$tid] ?? null;
        } else {
            return self::$context[$tid][$key] ?? null;
        }
    }

    public static function set($key, $context)
    {
        $tid = Coroutine::getCid();
        self::$context[$tid][$key] = $context;
    }

    public static function printContext()
    {
        print_r(self::$context);
    }

    public static function destroy()
    {
        $tid = Coroutine::getCid();
        unset(self::$context[$tid]);
    }
}

