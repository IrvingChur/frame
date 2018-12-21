<?php
/**
 * auth irving
 * describe 缓存配置
 */

// 目前支持格式
$cacheConfig = [
    // redis缓存
    'redis' => [
        'mode' => 'redis',
        'host' => '127.0.0.1',
        'port' => '6379',
        'auth' => 'auth',
    ],
];

// 使用缓存类型
$returnConfig = $cacheConfig['redis'];

return $returnConfig;