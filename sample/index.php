<?php

// 应用名称
define('APP_NAME', 'sample');

// 注册自动导入 - 框架
include dirname(__DIR__) . "/src/Autoload.php";
\gospel24\framework\Autoload::register(
    dirname(__DIR__) . "/src", 'gospel24\\framework'
);

// 注册自动导入 - 应用
\gospel24\framework\Autoload::register(
    dirname(__DIR__) . "/sample", APP_NAME
);

// bootstrap and get option
$option = include 'bootstrap.php';

// 启动框架引擎
\gospel24\framework\Engine::start($option);