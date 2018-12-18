<?php
/**
 * auth irving
 * describe 注册路由并返回路由集合
 */
namespace Route;


class RouteGather
{
    private static $gather = [];

    /**
     * @title 返回路由集合信息
     * @return void
     */
    public static function loadGather()
    {
        // 在数组中添加路由区
        self::$gather = [
            \Route\Admin\login::class
        ];

        self::registerRoutes();
    }

    /**
     * @title 注册路由集合
     * @return void
     */
    private static function registerRoutes()
    {
        foreach (self::$gather as $value) {
            (new $value)->routeRegister();
        }
    }
}