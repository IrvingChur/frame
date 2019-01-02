<?php

/**
 * auth irving
 * describe 基于swoole协程处理日志
 */

namespace Framework\Swoole;

class LogSystem {

    private $service;

    /**
     * @title 初始化构造swoole
     * @return void
     */
    public function __construct()
    {
        $this->service = new \Swoole\Server('0.0.0.0', 9501, SWOOLE_BASE, SWOOLE_SOCK_TCP);
        $this->setServiceConfig();
        $this->registerFunction();
    }

    /**
     * @title 设置swoole参数
     * @return void
     */
    private function setServiceConfig()
    {

        $this->service->set([
            'worker_num' => 1,
            'backlog' => 256,
            'max_request' => 10000,
            'dispatch_mode' => 3,
//            'daemonize' => 0,
            'heartbeat_check_interval' => 5,
            'heartbeat_idle_time' => 10,
        ]);
    }

    /**
     * @title 注册事件
     * @return void
     */
    private function registerFunction()
    {
        // 在此数组中加入需要注册的事件
        $functions = [
            [
                'swooleFunction' => 'Receive',
                'businessFunction' => 'onReceive',
            ]
        ];

        // 轮询注册
        try {
            foreach ($functions as $key => $value) {
                $this->service->on($value['swooleFunction'], [$this, $value['businessFunction']]);
            }
        } catch (\Exception $e) {
            // 注册失败时工作
        }
    }

    /**
     * @title 递归创建目录
     * @param $dirPath string 目录
     * @return boolean
     */
    private function createDir($dirPath)
    {
        // 如果目录已经存在，直接返回
        if(is_dir($dirPath)) {
            return true;
        }
        return is_dir(dirname($dirPath)) || $this->createDir(dirname($dirPath)) ? mkdir($dirPath) : false;
    }

    /**
     * @title 日志写入操作
     * @param $data mixed 日志数据
     * @return boolean
     */
    private function writeLog($data)
    {
        // 解析日志数据
        $data = unserialize($data);
        $path = $data['path'];
        $this->createDir(RUNTIME_PATH.'/'.$path);
        $data['dirPath'] = $path;

        // 写入文件
        $fileName = date('Y-m-d', time());
        $fileName = $fileName.'.log';
        $fileName = RUNTIME_PATH.'/'.$data['dirPath'].'/'.$fileName;
        $string = date('Y-m-d H:i:s').':'.$data['log'].PHP_EOL;
        $fileSource = fopen($fileName, 'a');
        if (flock($fileSource, LOCK_EX)) {
            fwrite($fileSource, $string);
            fflush($fileSource);
            flock($fileSource, LOCK_UN);
        }
        return true;
    }

    /**
     * @title 接收事件
     * @param $server object swoole_server对象
     * @param $fd string 唯一标识
     * @param $reactorId string Reactor线程id
     * @param $data mixed 数据
     * @return void
     */
    public function onReceive($server, $fd, $reactorId, $data)
    {
        $result = $this->writeLog($data);
//        $server->send($fd, $result);
    }

    /**
     * @title 运行
     * @return void
     */
    public function run()
    {
        $this->service->start();
    }
}