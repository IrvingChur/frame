<?php
/**
 * auth irving
 * describe 路由调度核心
 */
namespace Framework\Kernel;

class Dispatch
{
    private static $pathInfo = '';
    private static $requestMethod = '';

    public static $url = [];

    /**
     * @title url调度
     * @return void
     */
    public static function dispatchUrl()
    {
        self::$pathInfo = @$_SERVER['PATH_INFO'];
        self::$requestMethod = $_SERVER['REQUEST_METHOD'];
        self::$url  = self::searchRoute();

        // 调度中设置日志系统目录
        LogSystem::setPath(self::$url['class']);
    }

    /**
     * @title 搜寻路由
     * return array
     */
    private static function searchRoute()
    {
        $routes = RouteBinding::init()->getRoutes(strtolower(self::$requestMethod));
        $route = @$routes[self::$pathInfo];
        if (empty($route)) {
            throw new \Exception("路由不存在");
        }

        return $route;
    }
}