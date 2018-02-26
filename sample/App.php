<?php
namespace sample;

/**
 * Class App
 * @package sample
 */
class App extends \gospel24\framework\abstracts\App
{
    /**
     * Injection
     * @var string
     */
    private $pathInfo = '';

    /**
     * 启动应用
     */
    public function run()
    {
        echo 'Hello World!', "\n";
        echo 'pathInfo: ', implode('/', $this->pathInfo);
        echo "\n";

    }
}