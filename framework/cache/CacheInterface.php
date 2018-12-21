<?php
/**
 * auth irving
 * describe Cache接口类
 */

namespace Framework\Cache;


abstract class CacheInterface
{
    // 定义获取方法
    abstract public function get(string $key);

    // 定义设定方法
    abstract public function set(string $key, $value);

    // 定义设定数组方法
    abstract public function setArray(string $key, $value);

    /**
     * @title 返回原对象
     * @return mixed
     */
    public function getOriginalObject()
    {
        if (!empty($this->originalObject)) {
            return $this->originalObject;
        }

        return false;
    }

    /**
     * @title 将mixed转化为string
     * @return string
     */
    public function conversion($mixed)
    {
        return serialize($mixed);
    }
}