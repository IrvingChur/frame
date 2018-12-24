<?php

/**
 * auth irving
 * describe 依赖注入
 */

namespace Framework\Kernel;

class Ioc {

    protected static $object= []; // 存储已实例化对象

    /**
     * @title 获取实例
     * @param string $className 类名
     * @return object
     */
    public static function getInstance(string $className)
    {
        $paramArr = self::getMethodParams($className);
        return (new \ReflectionClass($className))->newInstanceArgs($paramArr);
    }

    /**
     * @title 获取实例类
     * @param string $className 类名
     * @param string $methodName 方法名
     * @param array $params 额外参数
     * @param boolean $newCreate 是否强制建立新对象
     * @return mixed
     */
    public static function make(string $className, string $methodName = '', array $params = [], $newCreate = false)
    {
        if (isset(self::$object[$className]) && $newCreate === false) {
            $object = self::$object[$className];
        } else {
            // 获取实例object
            $object = self::getInstance($className);
            // 保存实例
            self::$object[$className] = $object;
        }

        if ($methodName != '') {
            // 获取该方法所需要依赖注入的参数
            $paramArr = self::getMethodParams($className, $methodName);
            return $object->{$methodName}(...array_merge($paramArr, $params));
        }

        return $object;
    }

    /**
     * @title 获取方法的参数
     * @param string $className 类名
     * @param string $methodName 方法名
     * @return array
     */
    public static function getMethodParams(string $className, string $methodName = '__construct')
    {
        // 通过反射获取该类详情
        $classDescribe = new \ReflectionClass($className);
        $paramArr = [];

        // 判断是否有需要的method
        if ($classDescribe->hasMethod($methodName)) {
            // 获得构造函数
            $construct = $classDescribe->getMethod($methodName);
            // 判断构造函数是否有参数
            $params = $construct->getParameters();

            if (count($params) > 0) {
                foreach ($params as $index => $param) {
                    // 类是否存在
                    if ($paramClass = $param->getClass()) {
                        // 获得参数类型名称
                        $paramClassName = $paramClass->getName();

                        $args = self::getMethodParams($paramClassName);
                        $paramArr[] = (new \ReflectionClass($paramClass->getName()))->newInstanceArgs($args);
                    }

                }
            }
        }

        return $paramArr;
    }

}