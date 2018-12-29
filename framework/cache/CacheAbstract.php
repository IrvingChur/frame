<?php
/**
 * auth irving
 * describe Cache抽象类
 */

namespace Framework\Cache;


abstract class CacheAbstract
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
    protected function conversion($mixed)
    {
        return serialize($mixed);
    }

    /**
     * @title 返回数据
     * @param string $data
     * @return mixed
     */
    protected function result(string $data)
    {
        if ($this->isSerialized($data)) {
            return unserialize($data);
        }

        return $data;
    }

    /**
     * @title 判断是否为序列化
     * @param string $data
     * @return boolean
     */
    protected function isSerialized(string $data) {
        $data = trim( $data );
        if ( 'N;' == $data )
            return true;
        if ( !preg_match( '/^([adObis]):/', $data, $badions ) )
            return false;
        switch ( $badions[1] ) {
            case 'a' :
            case 'O' :
            case 's' :
                if ( preg_match( "/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data ) )
                    return true;
                break;
            case 'b' :
            case 'i' :
            case 'd' :
                if ( preg_match( "/^{$badions[1]}:[0-9.E-]+;\$/", $data ) )
                    return true;
                break;
        }
        return false;
    }
}