<?php

namespace Application\admin\Controller;

use Application\Models\Admin\VillaAdminUserMenusModel;
use Extend\IocDemoExtend;
use Framework\Cache\Cache;
use Framework\Kernel\Ioc;
use Framework\Kernel\LogSystem;

class LoginController
{
    /**
     * @title 测试依赖注入
     * LoginController constructor.
     * @param IocDemoExtend $ioc
     */
    public function __construct(IocDemoExtend $ioc)
    {

    }

    /**
     * @title 后台主页[测试用例]
     * @method /admin
     */
    public function index()
    {
        $result = Ioc::make(IocDemoExtend::class);
        var_dump($result);
        exit;

        return [
            'code' => 200,
            'data' => null,
            'message' => '欢迎使用自定义框架',
        ];
    }
}