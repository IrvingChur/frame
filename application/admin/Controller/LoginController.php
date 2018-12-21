<?php

namespace Application\admin\Controller;

use Application\Models\Admin\VillaAdminUserMenusModel;
use Extend\IocDemoExtend;
use Framework\Cache\Cache;
use Framework\Kernel\LogSystem;

class LoginController
{
    /**
     * @title 后台主页[测试用例]
     * @method /admin
     */
    public function index(IocDemoExtend $ioc)
    {
        // 测试初始化cache
        $cacheObject = Cache::init()->getOriginalObject();
        var_dump($cacheObject);
        exit;

        return [
            'code' => 200,
            'data' => null,
            'message' => '欢迎使用自定义框架',
        ];
    }
}