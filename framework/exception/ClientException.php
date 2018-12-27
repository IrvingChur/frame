<?php
/**
 * @auth irving
 * @describe 客户端异常处理
 */

namespace Framework\Exception;

use Framework\Kernel\ResponseFormat;

class ClientException
{
    /**
     * @title 客户端异常抛出处理方法
     * @param \Exception $exception
     * @return void
     */
    public function handle(\Exception $exception)
    {
        // 非debug模式下只显示内容
        $response = [
            'code' => 500,
            'message' => '程序发生可预计错误，错误信息：'.$exception->getMessage(),
            'data' => null,
        ];
        ResponseFormat::output($response);
    }
}