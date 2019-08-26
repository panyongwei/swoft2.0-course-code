<?php

class Container
{
    private static $instance;

    protected $instances = [];

    private function __construct()
    {
    }

    public static function getInstance(): Container
    {
        if (!self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function get($key)
    {
        if (isset($this->instances[$key])) {
            return $this->instances[$key];
        } else {
            throw new \Exception('对象不存在');
        }
    }

    public function bind($key, $concrete = null)
    {
        if ($concrete instanceof Closure) {
            $this->instances[$key] = $concrete;
        } elseif (is_object($concrete)) {
            $this->instances[$key] = $concrete;
        }
        return $this;
    }
}

class Sunny
{
    public function getName()
    {
        echo "sunny\n";
    }
}

class Sunny1
{
    public function getName()
    {
        echo "sunny1\n";
    }
}

$app = Container::getInstance();
$app->bind(Sunny::class, new Sunny());
$app->bind(Sunny1::class,new Sunny1());
/** @var Sunny $sunny */
$sunny = $app->get(Sunny::class);
$sunny->getName();

/** @var Sunny1 $sunny1 */
$sunny1 = $app->get(Sunny1::class);
$sunny1->getName();

print_r($app);