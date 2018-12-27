<?php
/**
 * auth irving
 * describe 错误处理
 */
namespace Framework\Kernel;

use Framework\Exception\ClientException;

class Exception
{
    /**
     * @title 错误处理初始化
     * @return void
     */
    public static function init()
    {
        if (DEBUG_MODE) {
            // 开启php报错
            ini_set('display_errors', 'On');

            // 注册whoops
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        } else {
            // 关闭php报错
            ini_set('display_errors', 'Off');
            set_exception_handler([(new ClientException()), 'handle']);
        }
    }
}