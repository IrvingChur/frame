<?php
/**
 * auth irving
 * describe Redis类
 */
namespace Framework\Cache;


use Framework\Instrument\GetConfig;

class Redis extends CacheAbstract
{
    protected static $object;
    protected $originalObject;

    /**
     * @title 初始化redis
     * @return object
     */
    public static function init()
    {
        if (!self::$object instanceof Redis) {
            self::$object = new self();
        }

        self::$object->RedisConnect();
        return self::$object;
    }

    /**
     * @title 单例调度
     */
    private function __construct()
    {

    }

    /**
     * @title 单例调度
     */
    private function __clone()
    {

    }

    /**
     * @title redis连接设置
     * @return void
     */
    protected function RedisConnect()
    {
        $redisConfig = GetConfig::GetIncludeConfig(ROOT_PATH.'/config/common/CacheCOnfig.php');
        $this->originalObject = new \Redis();
        $this->originalObject->connect($redisConfig['host'], $redisConfig['port']);

        if (!empty($redisConfig['auth'])) {
            $this->originalObject->auth($redisConfig['auth']);
        }
    }

    public function set(string $key, $value)
    {
        return $this->originalObject->set($key, $value);
    }

    public function get(string $key)
    {
        return $this->originalObject->get($key);
    }

    public function setArray(string $key, $value)
    {
        $value = $this->conversion($value);
        return $this->set($key, $value);
    }
}