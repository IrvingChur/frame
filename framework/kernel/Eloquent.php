<?php
/**
 * auth irving
 * describe Eloquent初始化
 */
namespace Framework\Kernel;

use Illuminate\Database\Capsule\Manager as Capsule;

class Eloquent
{
    /**
     * @title 初始化Eloquent
     * @return void
     */
    public static function init()
    {
        $capsule = new Capsule;

        $capsule->addConnection(require ROOT_PATH.'/config/databases/default.php');

        $capsule->bootEloquent();
    }
}