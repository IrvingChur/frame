<?php
/**
 * auth irving
 * describe 日志常驻系统
 */
namespace Framework\Swoole;


class LogSystem
{
    private $service; //swoole服务实例

    public function __construct()
    {
        $this->service = new \swoole_server("0.0.0.0", 9501);
        $this->service->set(
            array(
                'worker_num' => 1, //进程数
//                'daemonize' => 1, //以守护进程执行
                'max_request' => 1000, //最大请求量
                'dispatch_mode' => 2,
                'task_worker_num' => 1, //task进程的数量
                'heartbeat_check_interval' => 5, //检测心跳
                'heartbeat_idle_time' => 10, // 10秒没心跳就断开连接
            )
        );

        // 注册事件
        $this->service->on('Receive',array($this,'onReceive'));
        $this->service->on('Task',array($this,'onTask'));
        $this->service->on('Finish',array($this,'onFinish'));
    }

    /**
     * @title 接收事件
     * @param $server object swoole_server对象
     * @param $fd string 唯一标识
     * @param $from_id string 线程id
     * @param $data mixed 数据
     */
    public function onReceive($server, $fd, $from_id, $data){
        $data = unserialize($data);
        $path = $data['path'];
        $this->mkdir(RUNTIME_PATH.'/'.$path);
        $data['dirPath'] = $path;

        $server->task($data);
    }

    /**
     * @title 递归创建目录
     * @param $dirPath string 目录
     * @return boolean
     */
    private function mkdir($dirPath)
    {
        // 如果目录已经存在，直接返回
        if(is_dir($dirPath)) {
            return true;
        }

        return is_dir(dirname($dirPath)) || $this->mkdir(dirname($dirPath)) ? mkdir($dirPath) : false;
    }

    /**
     * @title 执行任务事件
     * @param $server object swoole_server对象
     * @param $fd string 唯一标识
     * @param $from_id string 线程id
     * @param $data mixed 数据
     */
    public function onTask($server, $task_id, $from_id, $data){
        $fileName = date('Y-m-d', time());
        $fileName = $fileName.'.log';
        $fileName = RUNTIME_PATH.'/'.$data['dirPath'].'/'.$fileName;
        $string = date('Y-m-d H:i:s').':'.$data['log'].PHP_EOL;

        $fileSource = fopen($fileName, 'w');
        if (flock($fileSource, LOCK_EX)) {
            fwrite($fileSource, $string);
            fflush($fileSource);
            flock($fileSource, LOCK_UN);
        }

        return true;
    }

    /**
     * @title 任务完成事件
     * @param $server object swoole_server对象
     * @param $task_id string 任务id
     * @param $data mixed 数据
     */
    public function onFinish($serv, $task_id, $data){
        // 置空操作
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