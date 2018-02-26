<?php

/**
 * 应用配置
 */
$option = [];

// 应用名称 namespace
$option['app_name'] = APP_NAME;

/**
 * 应用初始化
 * @param $option
 */
$option['_init'] = function (&$option) {
    // 允许跨域请求
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Headers: x-requested-with');
};

/**
 * 异常处理
 * @param $e \Exception
 */
$option['_exception'] = function ($e) {
    echo $e->getMessage();
};

/**
 * 错误处理
 * @param $e \Error
 */
$option['_error'] = function ($e) {
    echo $e->getMessage();
};

/**
 * 自定义路由
 * @param $engine \gospel24\framework\Engine
 */
$option['_route'] = function ($engine) use ($argv) {

    // todo: if request cli
    $opt = getopt('u:');
    if (array_key_exists('u', $opt)) {

        $pathInfoStr = $opt['u'];
        $pathInfo = ($pathInfoStr === '/') ?  [] : explode('/', trim($pathInfoStr, '/'));

        $engine->setProp('pathInfoStr', $pathInfoStr);
        $engine->setProp('pathInfo', $pathInfo);
    }
};

/**
 * 自定义应用名
 * @param $engine \gospel24\framework\Engine
 */
$option['_app_name'] = function ($engine) {
    // todo
};

/**
 * 应用钩子
 * @param $engine \gospel24\framework\Engine
 */
$option['_app_hook'] = function ($engine) {
    // todo
};

return $option;