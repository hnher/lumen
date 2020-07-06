<?php
/**
 * ExampleRequest.php
 * Created On 2020/7/6 2:05 下午
 * Create by Retr0
 */

namespace App\Http\Requests;


class ExampleRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => '缺少参数:id'
        ];
    }
}
