<?php
/**
 * auth irving
 * describe 框架入口
 */

namespace Framework;

use Framework\Kernel\AutoLoad;
use Framework\Kernel\Dispatch;
use Framework\Kernel\Eloquent;
use Framework\Kernel\Exception;
use Framework\Kernel\Ioc;
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

        // Composer
        if (COMPOSER_PATH) {
            require COMPOSER_PATH.'/autoload.php';
        }

        // 异常处理
        Exception::init();

        // Eloquent初始化
        Eloquent::init();

        // 日志系统
        LogSystem::init();

        // 路由加载
        RouteGather::loadGather();

        // url调度
        Dispatch::dispatchUrl();
    }

    /**
     * @title 运行
     * @return void
     */
    public function run()
    {
        // 获取要调用的对象
        $controller = Dispatch::$url['class'];
        $function = Dispatch::$url['function'];

        // 获取依赖注入实例
        $object = Ioc::getInstance($controller);
        // 执行
        $result = call_user_func([$object, $function]);

        // 按照格式输出
        ResponseFormat::output($result);
    }

}