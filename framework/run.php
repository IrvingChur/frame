<?php
/**
 * auth irving
 * describe 框架入口
 */

namespace Framework;

use Framework\Kernel\AutoLoad;
use Framework\Kernel\Dispatch;
use Framework\Kernel\Exception;
use Framework\Kernel\LogSystem;
use Framework\Kernel\ResponseFormat;
use Route\RouteGather;

final class Framework {

    public function __construct()
    {
        $this->loadKernel();
    }

    /**
     * @title 核心驱动
     * @return void
     */
    public function loadKernel()
    {
        // 自动加载
        require ROOT_PATH.'/framework/kernel/AutoLoad.php';
        AutoLoad::init();

        // 异常处理
        Exception::init();

        // 日志系统
        LogSystem::init();

        // 路由加载
        RouteGather::loadGather();

        // url调度
        Dispatch::dispatchUrl();

        // Composer
        if (COMPOSER_PATH) {
            require COMPOSER_PATH.'/autoload.php';
        }
    }

    /**
     * @title 运行
     * @return void
     */
    public function run()
    {
        $controller = Dispatch::$url['class'];
        $function = Dispatch::$url['function'];
        $result = call_user_func([(new $controller()), $function]);
        echo ResponseFormat::responseFormat($result);
    }

}