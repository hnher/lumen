<?php

namespace App\Http\Controllers;

use App\Exceptions\User\UserNotLoginException;
use App\Facades\Log\Log;
use App\Modules\User\User;

class ExampleController extends Controller
{
    /**
     * 测试接口连通性
     * @return array
     */
    public function index(): array
    {
        Log::info('测试日志', ['a' => 1]);
        return [
            'app' => config('app.name'),
            'datetime' => date('Y-m-d H:i:s')
        ];
    }
}
