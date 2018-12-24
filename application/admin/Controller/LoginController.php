<?php

namespace Application\admin\Controller;

use Application\Models\Admin\VillaAdminUserMenusModel;
use Extend\IocDemoExtend;
use Framework\Cache\Cache;
use Framework\Instrument\GetParams;
use Framework\Kernel\Ioc;
use Framework\Kernel\LogSystem;

class LoginController
{
    protected $params;

    /**
     * @title 测试依赖注入
     * LoginController constructor.
     * @param IocDemoExtend $ioc
     */
    public function __construct(IocDemoExtend $ioc, GetParams $paramsObject)
    {
        $this->params = $paramsObject;
        var_dump($this->params);
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