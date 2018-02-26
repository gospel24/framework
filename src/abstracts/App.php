<?php
namespace gospel24\framework\abstracts;

/**
 * Class App
 * @package gospel24\framework\abstracts
 */
abstract class App
{
    /**
     * App constructor.
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * 初始化应用
     */
    protected function initialize() {}

    /**
     * 执行应用
     */
    public function run() {}
}