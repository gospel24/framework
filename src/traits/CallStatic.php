<?php
namespace gospel24\framework\traits;

/**
 * Trait CallStatic
 * @package gospel24\framework\traits
 */
trait CallStatic
{
    /**
     * 静态调用
     * @param $method
     * @param $params
     * @return mixed
     * @throws \Exception
     */
    public static function __callStatic($method, $params)
    {
        $call = substr($method, 1);
        if (0 === strpos($method, '_') && is_callable([self::instance(), $call])) {
            return call_user_func_array([self::instance(), $call], $params);
        } else {
            throw new \Exception("method not exists:" . $method);
        }
    }
}
