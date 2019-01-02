<?php
/**
 * auth irving
 * describe 获取参数类
 */
namespace Framework\Instrument;


use Framework\Kernel\Dispatch;
use Framework\Kernel\RouteBinding;

class GetParams
{
    protected $data = [];

    public function __construct()
    {
        // put delete 获取方式
        parse_str(file_get_contents('php://input'), $data);
        $this->data[Dispatch::$requestMethod] = $data;
        $this->data['GET'] = $_GET;
        $this->data['POST'] = $_POST;
    }

    /**
     * @title 获取参数
     * @param string $method 请求方法
     * @param string $index
     */
    public function getParam(string $method, string $index = '')
    {
        $method = strtoupper($method);

        if (!in_array(strtolower($method), RouteBinding::ROUTE_METHOD)) {
            throw new \Exception("暂不支持该方法参数");
        }

        $data = $this->data[$method] ?? $this->data;
        if ($index != '' && isset($this->data[$index])) {
            $data = $data[$index];
        }

        return $data;
    }

    /**
     * @title 魔术方法,获取对应方法参数
     * @param string $method
     */
    public function __get(string $method)
    {
        $method = strtoupper($method);

        if (isset($this->data[$method])) {
            return $this->data[$method];
        }

        return $this;
    }
}