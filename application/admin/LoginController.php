<?php

namespace Application\admin;

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
        $res = LogSystem::writeLog('12313133');
        var_dump($res);
        exit;

        return [
            'code' => 200,
            'data' => null,
            'message' => '欢迎使用自定义框架',
        ];
    }
}