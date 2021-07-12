<?php
/**
 * GetListRequest.php
 * Create By PhpStorm
 * Module hnher
 * Date 2020/12/30
 * Time 5:21 下午
 */

namespace App\Traits;

/**
 * 获取列表基类
 * Trait GetListRequest
 * @package App\Traits
 */
trait GetListRequest
{
    /**
     * 验证规则
     * @return string[]
     */
    public function rule(): array
    {
        return [
            'page' => 'integer',
            'limit' => 'integer',
        ];
    }

    /**
     * 异常消息
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'page.integer' => '参数:page 必须是整数',
            'limit.integer' => '参数:limit 必须是整数'
        ];
    }
}
