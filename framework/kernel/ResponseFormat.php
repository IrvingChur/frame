<?php

/**
 * auth irving
 * describe api返回格式化定义
 */

namespace Framework\Kernel;

class ResponseFormat
{
    /**
     * @title 返回指定格式
     * @param $data mixed 数据
     * @return array 指定格式的数据
     */
    public static function responseFormat($data)
    {
        $data = [
            'code' => intval($data['code']),
            'data' => $data['data'],
            'message' => (string) $data['message'],
        ];

        $format = self::getFormat();
        switch ($format) {
            case 'json':
                $data = json_encode($data);
                header('Content-type:text/json');
                break;
            default:
                $data = json_encode($data);
                header('Content-type:text/json');
                break;
        }

        return $data;
    }

    public static function output($data)
    {
        $message = self::responseFormat($data);
        echo $message;

        // 冲刷缓存区,即时返回
        fastcgi_finish_request();
    }

    private static function getFormat()
    {
        return require ROOT_PATH.'/config/common/ResponseFormat.php';
    }
}