<?php

namespace Application\admin\Controller;

use Application\Models\Admin\VillaAdminUserMenusModel;
use Framework\Cache\Cache;
use Framework\Instrument\GetParams;
use Framework\Kernel\Ioc;
use Framework\Kernel\LogSystem;

class LoginController
{
    protected $paramObject;

    public function __construct(GetParams $getParams)
    {
        $this->paramObject = $getParams;
    }

    /**
     * @title 测试用例
     * @uri /admin
     * @method put
     */
    public function index()
    {
        // 测试依赖注入 + 获取置顶方法参数
        $put = $this->paramObject->put;
        return ['code' => 200, 'data' => $put, 'message' => '请求完成'];
    }

    /**
     * @title 测试用例
     * @uri /admin
     * @method delete
     */
    public function delete()
    {
        // 测试静态调度 + 获取方法
        $paramObject = Ioc::make(GetParams::class);
        $delete = $paramObject->getParam('delete');

        return ['code' => 200, 'data' => $delete, 'message' => '请求完成'];
    }
}