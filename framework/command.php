<?php
/**
 * auth irving
 * describe 命令入口
 */

namespace Framework;

// 定义目录
define('ROOT_PATH', dirname(__DIR__));
define('CONFIG_PATH', ROOT_PATH.'/config');
define('APP_PATH', ROOT_PATH.'/application');
define('RUNTIME_PATH', ROOT_PATH.'/runtime');
define('COMPOSER_PATH', ROOT_PATH.'/vendor');

use Framework\Kernel\AutoLoad;
use Framework\Kernel\CommandDispatch;

final class Command {

    public function __construct()
    {
        $this->loadCommandKernel();
    }

    /**
     * @title 加载框架核心组件
     * @return void
     */
    public function loadCommandKernel()
    {
        // 自动加载
        require ROOT_PATH.'/framework/kernel/AutoLoad.php';
        AutoLoad::init();

    }

    /**
     * @title 运行
     * @return void
     */
    public function run()
    {
        $dispatch = CommandDispatch::dispatchCommand();
        if (isset($dispatch['params'])) {
            call_user_func([(new $dispatch['class']), $dispatch['function']], $dispatch['params']);
        } else {
            call_user_func([(new $dispatch['class']), $dispatch['function']]);
        }
    }

}

(new Command())->run();