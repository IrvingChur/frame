<?php
/**
 * auth irving
 * describe 命令行路由调度类
 */
namespace Framework\Kernel;


class CommandDispatch
{
    /**
     * @title 返回命令行格式
     * @return array
     */
    public static function dispatchCommand()
    {
        $longOpt = array(
            'class:',
            'function:',
            'params::',
        );
        $param = getopt('', $longOpt);

        return $param;
    }
}