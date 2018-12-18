<?php

namespace Application\admin;

class LoginController
{
    /**
     * @title 后台主页[测试用例]
     * @method /admin
     */
    public function index()
    {
        return [
            'code' => 200,
            'data' => null,
            'message' => '欢迎使用自定义框架',
        ];
    }
}