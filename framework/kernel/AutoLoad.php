<?php
/**
 * auth irving
 * describe 自动加载类
 */
namespace Framework\Kernel;


class AutoLoad
{
    /**
     * @title 自动加载类初始化
     * @return void
     */
    public static function init()
    {
        spl_autoload_register([(new self), 'kernelAutoLoading']);
    }

    /**
     * @title 自动加载注册类
     * @param $class [string]
     * @return void
     */
    public static function kernelAutoLoading(string $class)
    {
        if (empty($class) || !is_string($class)) {
            throw new \Exception('组件加载错误');
        }

        $explodeClass = explode('\\', $class);
        $newClass = [];
        foreach ($explodeClass as $value) {
            if ($value != end($explodeClass)) {
                $newClass[] = strtolower($value);
            } else {
                $newClass[] = $value;
            }
        }

        $newClass = implode('/', $newClass);

        // 空判断操作
        if (include ROOT_PATH.'/'.$newClass.'.php') {

        } elseif (include ROOT_PATH.'/'.$newClass.'Controller.php') {

        }
    }
}