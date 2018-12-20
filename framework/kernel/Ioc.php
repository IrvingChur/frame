<?php

namespace Framework\Kernel;

/**
 * auth irving
 * describe 依赖注入核心
 */
class Ioc {

    /**
     * @title 获取类对象实例
     * @param $className \stdClass 类
     * @return array
     */
    public static function getInstance($className) {
        // 获取方法参数
        $param = self::getMethodParam($className);
        $paramObject = [];
        if (count($param) > 0) {
            $paramObject = self::createObject($param);
        }

        return $paramObject;
    }

    /**
     * @title 生成对应的对象
     * @param $param array 类组
     * @return array
     */
    public static function createObject($param)
    {
        $objectArray = [];
        foreach ($param as $key => $value) {
            foreach ($value as $valueOneMore) {
                $objectArray[$key][] = new $valueOneMore->name();
            }
        }

        return $objectArray;
    }

    /**
     * @title 获取方法参数
     * @param $className \stdClass 类
     * @return array
     */
    public static function getMethodParam($className) {
        // 通过反射获得该类
        $class = new \ReflectionClass($className);
        $param = [];

        $construct = $class->getMethods();
        if (count($construct) > 0) {
            foreach ($construct as $key => $value) {
                $valueParam = $value->getParameters();
                if (count($valueParam) > 0) {
                    foreach ($valueParam as $valueParamKey => $valueParamValue) {
                        $paramClassNameAll = $valueParamValue->getClass();
//                        $paramClassName = $valueParamValue->getName();

                        $param[$value->name][] = $paramClassNameAll;
                    }
                }
            }
        }

        return $param;
    }
}