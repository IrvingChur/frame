<?php
/**
 * auth irving
 * describe 框架入口
 */

namespace Framework;

use Framework\Kernel\AutoLoad;
use Framework\Kernel\Dispatch;
use Framework\Kernel\ResponseFormat;
use Route\RouteGather;

final class Framework {

    public function __construct()
    {
        $this->loadKernel();
        $this->setReporting();
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

        // 路由加载
        RouteGather::loadGather();

        // url调度
        Dispatch::dispatchUrl();
    }

    /**
     * @title 错误报告
     * @return void
     */
    public function setReporting()
    {
        if (DEBUG_MODE === true) {
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors', 'Off');
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