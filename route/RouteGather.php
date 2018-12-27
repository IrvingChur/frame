<?php
/**
 * auth irving
 * describe 注册路由并返回路由集合
 */
namespace Route;


use Application\Admin\RouteMiddle\Measurement;

class RouteGather
{
    private static $gather = [];
    private static $middle = [];

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
        self::registerMiddle();
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

    /**
     * @title 加载路由中间件集合
     * @return void
     */
    private static function registerMiddle()
    {
        // 在数组中加入中间件组
        self::$middle = [
            'middleGroup' => [
                // 这边输入middle的class
                Measurement::class,
            ]
        ];
    }

    /**
     * @title 返回中间件组
     * @return array
     */
    public static function getMiddleGroup(string $middleGroupName = '')
    {
        if (!empty($middleGroupName)) {
            return self::$middle[$middleGroupName];
        }

        return self::$middle;
    }
}