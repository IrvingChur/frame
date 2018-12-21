<?php

namespace Application\admin\Controller;

use Application\Models\Admin\VillaAdminUserMenusModel;
use Extend\IocDemoExtend;
use Framework\Kernel\LogSystem;

class LoginController
{
    /**
     * @title 后台主页[测试用例]
     * @method /admin
     */
    public function index(IocDemoExtend $ioc)
    {
        $model = new VillaAdminUserMenusModel();
        $res = $model::find(2);
        $res = $res->toArray();
        var_dump($res);
        exit;

        return [
            'code' => 200,
            'data' => null,
            'message' => '欢迎使用自定义框架',
        ];
    }
}