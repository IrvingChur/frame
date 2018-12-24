<?php
/**
 * auth irving
 * describe 处理抛出异常类
 */

namespace Framework\exception;


class ExceptionHandle
{
    /**
     * @title 抛出异常处理
     * @param \Exception $e 异常堆栈
     * @return void
     */
    public static function handle($e)
    {
        if (DEBUG_MODE) {
            var_dump($e);
        } else {
            echo $e->getMessage();
        }
    }
}