<?php

class Container
{
    // 当前容器对象
    private static $instance;

    // 存放在容器里面到实例
    protected $instances = [];

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * 获取对象实例
     * @param $key
     * @return mixed
     * @throws ReflectionException
     */
    public function get($key)
    {
        if (isset($this->instances[$key])) {
            return $this->instances[$key];
        }
        return $this->make($key);
    }


    /**
     * 绑定对象、闭包、类到容器
     * @param $key
     * @param null $concrete
     * @return Container
     * @throws ReflectionException
     */
    public function bind($key, $concrete = null)
    {
        if ($concrete instanceof Closure) {
            $this->instances[$key] = $concrete;
        } elseif (is_object($concrete)) {
            $this->instances[$key] = $concrete;
        } else {
            $this->make($key, $concrete);
        }
        return $this;
    }

    /**
     * 创建类绑定到类实例
     * @param $abstract
     * @param null $atgs
     * @return mixed
     * @throws ReflectionException
     */
    public function make($abstract, $atgs = null)
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }
        $object = $this->invokeClass($abstract);
        $this->instances[$abstract] = $object;
        return $object;
    }

    /**
     * 反射解析类
     * @param $abstract
     * @return object
     * @throws ReflectionException
     */
    public function invokeClass($abstract)
    {
        $reflectionClass = new \ReflectionClass($abstract);

        // 获取构造方法
        $construct = $reflectionClass->getConstructor();

        // 获取参数得到实例
        $params = $construct ? $this->parserParams($construct) : [];
        $object = $reflectionClass->newInstanceArgs($params);
        return $object;
    }

    /**
     * 解析构造方法参数
     * @param $reflect
     * @return array
     * @throws ReflectionException
     */
    public function parserParams(ReflectionMethod $reflect)
    {
        $args = [];
        $params = $reflect->getParameters();
        if (!$params) {
            return $args;
        }
        if (count($params) > 0) {
            foreach ($params as $param) {
                $class = $param->getClass();
                if ($class) {
                    $args[] = $this->make($class->getName());
                    continue;
                }
                // 获取变量的名称
                $name = $param->getName();
                // 默认值
                $def = null;
                // 如果有默认值，从默认值获取类型
                if ($param->isOptional()) {
                    $def = $param->getDefaultValue();
                }
                $args[] = $_REQUEST[$name] ?? $def;
            }
        }
        return $args;
    }
}

