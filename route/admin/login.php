<?php
/**
 * auth irving
 * describe 登录区路由
 */

namespace Route\Admin;

use Application\admin\Controller\LoginController;
use Framework\Kernel\RouteBinding;

class login
{
    private $kernelRoute;

    public function __construct()
    {
        $this->kernelRoute = RouteBinding::init();
    }

    public function routeRegister()
    {
        $this->kernelRoute->bindingRoute('/admin', LoginController::class, 'index')->assignMethod('GET');
    }
}