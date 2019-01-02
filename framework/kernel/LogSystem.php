<?php
/**
 * auth irving
 * describe 日志系统
 */
namespace Framework\Kernel;


class LogSystem
{
    protected static $client;
    public static $path;

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
     * @title 设置目录
     * @param $class string 访问类名
     * @return array 应用详情
     */
    public static function setPath(string $class)
    {
        if (empty($class)) {
            throw new \Exception("日志目录不可为空");
        }

        $classExplode = explode('\\', $class);
        $index = 0;
        foreach ($classExplode as $key => $value) {
            if ($value == 'Application') {
                $index = $key + 1;
                break;
            }
        }

        $path = $classExplode[$index];
        if (!isset($classExplode[$index]) || $index === 0) {
            $path = 'unknown';
        }

        self::$path = $path;
    }

    /**
     * @title 写日志
     * @throws \Exception
     * @return boolean
     */
    public static function writeLog($string)
    {
        self::connect();
        $trace = [];
        $trace['path'] = self::$path;
        $trace['log'] = $string;
        $sendResult = self::$client->send(serialize($trace));
//        $result = self::$client->recv(); // 阻塞等待回复(关闭)
        self::$client->close();
        return $result ?? $sendResult ;
    }
}