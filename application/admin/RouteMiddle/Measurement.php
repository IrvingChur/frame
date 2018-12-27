<?php
/**
 * auth irving
 * describe 中间件测试用例
 */
namespace Application\Admin\RouteMiddle;


class Measurement
{
    /**
     * @title 测试用例
     * @return void
     */
    public function handle()
    {
        echo '中间件'.__CLASS__.PHP_EOL;
    }
}