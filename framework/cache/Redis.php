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
        $redisConfig = GetConfig::GetIncludeConfig(ROOT_PATH.'/config/common/CacheConfig.php');
        $this->originalObject = new \Redis();
        $this->originalObject->connect($redisConfig['host'], $redisConfig['port']);

        if (!empty($redisConfig['auth'])) {
            $this->originalObject->auth($redisConfig['auth']);
        }
    }

    /**
     * @title 设置缓存
     * @param string $key
     * @param $value
     * @return mixed
     */
    public function set(string $key, $value)
    {
        return $this->originalObject->set($key, $value);
    }

    /**
     * @title 获取缓存
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        $result = $this->originalObject->get($key);
        return $this->result($result);
    }

    /**
     * @title 设置数组缓存
     * @param string $key
     * @param $value
     * @return mixed
     */
    public function setArray(string $key, $value)
    {
        $value = $this->conversion($value);
        return $this->set($key, $value);
    }
}