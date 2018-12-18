<?php

/**
 * auth irving
 * describe 入口文件
 */

// 定义目录
define('ROOT_PATH', dirname(__DIR__));
define('CONFIG_PATH', ROOT_PATH.'/config');
define('APP_PATH', ROOT_PATH.'/application');
define('RUNTIME_PATH', ROOT_PATH.'/runtime');
define('COMPOSER_PATH', ROOT_PATH.'/vendor');
define('DEBUG_MODE', true);

// 引入framework
require dirname(__DIR__).'/framework/run.php';

(new \Framework\Framework())->run();