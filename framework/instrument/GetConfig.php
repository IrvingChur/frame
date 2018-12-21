<?php
/**
 * auth irving
 * describe 获取配置
 */

namespace Framework\Instrument;


class GetConfig
{
    /**
     * @title 根据文件获取里面的配置
     * @param string $path 文件位置
     * @return mixed
     */
    public static function GetIncludeConfig(string $path)
    {
        if (file_exists($path)) {
            $result = include $path;
        } else {
            throw new \Exception("配置文件不存在");
        }

        return $result;
    }
}