<?php
/**
 * auth irving
 * describe 错误处理
 */
namespace Framework\Kernel;


use Framework\exception\ExceptionHandle;

class Exception
{
    /**
     * @title 错误处理初始化
     * @return void
     */
    public static function init()
    {
        // 注册报错处理方法
        set_exception_handler([(new ExceptionHandle()), 'handle']);
        // 错误异常处理
        self::setReporting();
    }

    /**
     * @title 错误报告
     * @return void
     */
    public static function setReporting()
    {
        if (DEBUG_MODE === true) {
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
        } else {
            error_reporting(0);
            ini_set('display_errors', 'Off');
        }
    }
}