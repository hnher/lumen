<?php
/**
 * 请将所有的异常状态码和文字描述在此处定义
 * ErrorConstant.php
 * Created On 2020/2/19 10:47 上午
 * Create by retr
 */

namespace App\Constants;


class ErrorConstant
{
    /**
     * 此处声明对应的 HTTP 状态码返回文字信息，用于覆盖原有的 HTTP 状态信息
     */
    const HTTP_ERROR = [
        404 => '接口不存在',
        405 => '请求方式错误',
        403 => '无权访问',
        422 => '请求参数异常'
    ];

    //用户未登录
    const NOT_LOGIN = [
        'code' => 40003,
        'message' => '未登录'
    ];
}
