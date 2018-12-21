<?php

/**
 * auth irving
 * describe 数据库配置
 */

$config = [
    'mysql' => [
        'read' => [
            'host' => '127.0.0.1'
        ],
        'write' => [
            'host' => '127.0.0.1'
        ],

        // 配置文件
        'driver'    => 'mysql',
        'database'  => 'villa',
        'username'  => 'root',
        'password'  => 'root',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ],
];

// 指定使用mysql
return $config['mysql'];