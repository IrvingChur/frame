<?php
/**
 * auth irving
 * describe 日志系统
 */
namespace Framework\Kernel;


class LogSystem
{
    protected static $client;

    /**
     * @title 初始化日志系统
     * @return void
     */
    public static function init()
    {
        self::$client = new \swoole_client(SWOOLE_SOCK_TCP);
    }

    /**
     * @title 连接检测
     * @throws \Exception
     * @return void
     */
    public static function connect()
    {
        if(!self::$client->connect('127.0.0.1', 9501, 1)){
            throw new \Exception('swoole连接错误,错误代码:'.self::$client->errCode);
        }
    }

    /**
     * @title 获取应用详情
     * @return array 应用详情
     */
    public static function getTrace()
    {
       $trace = debug_backtrace();
       $upTrace = $trace[1];

       return $upTrace;
    }

    /**
     * @title 写日志
     * @throws \Exception
     * @return boolean
     */
    public static function writeLog($string)
    {
        self::connect();
        $trace = self::getTrace();
        $trace['log'] = $string;
        $result = self::$client->send(serialize($trace));

        return $result ? true : false ;
    }
}