<?php
namespace gospel24\framework;

use gospel24\framework\abstracts\App;
use gospel24\framework\exception\Exception;
use gospel24\framework\library\Injection;

/**
 * Class Engine
 * @package gospel24\framework
 */
class Engine
{
    private $option = [];

    private $pathInfoStr = '';
    private $pathInfo = [];

    private $appClassName = '';
    private $app = null;

    /**
     * 启动引擎
     * @param array $option
     */
    public static function start(array $option)
    {
        try {

            // hook 初始化
            self::hook($option, '_init', $option);

            // 启动引擎
            (new self())->run($option);

        } catch (\Exception $e) {

            // hook 异常处理
            self::hook($option, '_exception', $e);

        } catch (\Error $e) {

            // hook 错误处理
            self::hook($option, '_error', $e);
        }
    }

    /**
     * 启动引擎
     * @param $option
     * @throws Exception
     */
    private function run($option)
    {
        // 配置
        $this->option = $option;

        // 获取 pathInfoStr
        $this->pathInfoStr = array_key_exists('PATH_INFO', $_SERVER) ? $_SERVER['PATH_INFO'] : '/';

        // 解析 pathInfoStr
        $this->pathInfo = ($this->pathInfoStr === '/') ?  [] : explode('/', trim($this->pathInfoStr, '/'));

        // hook 路由
        self::hook($this->option, '_route', $this);

        // 设置 默认应用
        $this->appClassName = isset($this->option['app_name']) === true ? ( '\\' . $this->option['app_name'] . '\\App') : '';

        // hook 应用名
        self::hook($this->option, '_app_name', $this);

        // 初始化 应用反射类
        $appReflection = new \ReflectionClass($this->appClassName);
        if ($appReflection->isSubclassOf(App::class) === false) {
            throw new Exception('APP继承错误: ' . App::class);
        }

        // 通过反射 生成应用实例
        $this->app = $appReflection->newInstanceArgs();

        // 依赖注入
        Injection::object($this->app, array(
            'option'   => $this->option,
            'pathInfo' => $this->pathInfo
        ));

        // hook 应用
        self::hook($this->option, '_app_hook', $this);

        // 执行应用
        $this->app->run();
    }

    /**
     * @param $option
     * @param $name
     * @param $object
     */
    private static function hook($option, $name, &$object)
    {
        if (self::isClosure($option, $name)) {
            $option[$name]($object);
        }
    }

    /**
     * @param $option
     * @param $name
     * @return bool
     */
    private static function isClosure($option, $name)
    {
        return (isset($option[$name]) && $option[$name] instanceof \Closure) ? true : false;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getProp($name)
    {
        return $this->{$name};
    }

    /**
     * @param $name
     * @param $value
     */
    public function setProp($name, $value)
    {
        $this->{$name} = $value;
    }

}