<?php
/**
 * auth irving
 * describe 路由加载核心
 */

namespace Framework\Kernel;


class RouteBinding
{
    const ROUTE_METHOD = [
        'get','post','put','delete'
    ];

    private static $selfObject;

    // 保存post
    protected $postRoutes = [];
    // 保存get
    protected $getRoutes = [];
    // 保存put
    protected $putRoutes = [];
    // 保存delete
    protected $deleteRoutes = [];
    // 临时保存路由
    protected $saveRoute = [];
    // 临时保存地址
    protected $saveAddress;

    private function __construct()
    {
        // 单例调用
    }

    private function __clone()
    {
        // 单例调用
    }

    public static function init()
    {
        if (empty(self::$selfObject)) {
            self::$selfObject = new self();
        }

        return self::$selfObject;
    }

    /**
     * @title 绑定路由
     * @return object
     */
    public function bindingRoute(string $route, $class, string $funciton)
    {
        if (!is_string($route) || (strpos($route, '/') === false)) {
            throw new \Exception("路由格式错误,请检查路由配置");
        } elseif (!class_exists($class)) {
            throw new \Exception("路由指定类不存在");
        } elseif (!is_string($funciton)) {
            throw new \Exception("方法必须为合法字符串");
        }

        $this->saveRoute = [
            $route => [
                'class' => $class,
                'function' => $funciton,
            ],
        ];
        return $this;
    }

    /**
     * @title 指定路由方法
     * @param $method string 路由方法[get|post|put|delete]
     * @return object
     */
    public function assignMethod(string $method)
    {
        $method = strtolower($method);
        if (!in_array($method, RouteBinding::ROUTE_METHOD)) {
            throw new \Exception("路由格式错误,指定方法不存在,请检查路由配置");
        }

        $methodVarName = $method.'Routes';

        if (!in_array($method, $this->$methodVarName)) {
            $this->$methodVarName[key($this->saveRoute)] = reset($this->saveRoute);
            $this->saveAddress = &$this->$methodVarName[key($this->saveRoute)];
        }

        return $this;
    }

    /**
     * @title 绑定中间件
     * @param string $middleGroupName 中间件组名
     * @return object
     */
    public function bindingMiddle(string $middleGroupName)
    {
        if (empty($middleGroupName)) {
            throw new \Exception("中间件组名不能为空");
        }

        $this->saveAddress['middleGroup'] = $middleGroupName;
        return $this;
    }

    /**
     * @title 获取对象内路由配置
     * @param $method string 指定路由方法
     * @return array
     */
    public function getRoutes(string $method = null)
    {
        $allUrl = [
            'get' => $this->getRoutes,
            'post' => $this->postRoutes,
            'put' => $this->putRoutes,
            'delete' => $this->deleteRoutes,
        ];

        if (!empty($method) && in_array($method, RouteBinding::ROUTE_METHOD)) {
            return $allUrl[$method];
        } else {
            return $allUrl;
        }
    }
}