<?php
/**
 * Application.php
 * 此处如果需要更改应用程序行为，在此处理
 * Created On 2020/2/20 11:24 上午
 * Create by retr
 */

namespace App;

use App\Models\BaseModel;
use Laravel\Lumen\Application as LumenApplication;

class Application extends LumenApplication
{
    public function boot()
    {
        //全链路跟踪 uuid 全局唯一 每次请求/日志 uuid 保持一致
        app()->uuid = BaseModel::uuid();
        parent::boot();
    }
}
