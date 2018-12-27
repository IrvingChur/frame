<?php
/**
 * auth irving
 * describe 路由中间件核心
 */

namespace Framework\Kernel;


use Route\RouteGather;

class RouteMiddle
{
    private static $object;

    private function __construct()
    {
        // 单例调用
    }

    private function __clone()
    {
        // 单例调用
    }

    /**
     * @title 单例调用入口
     * @return object
     */
    public static function init()
    {
        if (!self::$object instanceof RouteMiddle) {
            self::$object = new self();
        }

        return self::$object;
    }

    /**
     * @title 加载并执行中间件
     * @param string $middleGroupName 中间件组名
     * @return void
     */
    public function loadRouteMiddle(string $middleGroupName)
    {
        $middleGroup = RouteGather::getMiddleGroup($middleGroupName);

        // 中间件执行
        if (count($middleGroup) > 0) {
            foreach ($middleGroup as $key => $value) {
                call_user_func([(new $value), 'handle']);
            }
        }
    }
}