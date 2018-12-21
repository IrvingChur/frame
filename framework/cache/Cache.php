<?php
/**
 * Created by PhpStorm.
 * User: IrvingChur
 * Date: 2018/12/22
 * Time: 上午12:19
 */

namespace Framework\Cache;


use Framework\Instrument\GetConfig;

class Cache
{
    public static $cacheObject;

    /**
     * Cache constructor.
     * describe 根据配置初始化Cache工具
     */
    public static function init()
    {
        $cacheConfig = GetConfig::GetIncludeConfig(ROOT_PATH.'/config/common/CacheConfig.php');
        switch ($cacheConfig['mode']) {
            case 'redis':
                self::$cacheObject = Redis::init();
                break;
        }

        return self::$cacheObject;
    }
}