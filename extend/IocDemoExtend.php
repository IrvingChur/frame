<?php
/**
 * Created by PhpStorm.
 * User: IrvingChur
 * Date: 2018/12/20
 * Time: 下午7:03
 */

namespace Extend;


class IocDemoExtend
{
    public function __construct(IocDemoExtend2 $ioc2)
    {
        $this->idd = $ioc2;
    }

    public $id = 1;
}