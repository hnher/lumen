<?php
/**
 * TestCommand.php
 * Created On 2020/6/18 2:42 下午
 * Create by Retr0
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestCommand extends Command
{
    protected $signature = 'Test:Test';

    protected $description = '测试使用脚本';

    /**
     * 业务处理
     */
    public function handle()
    {
        Log::info('abc', ['a' => 1]);
        throw new \Exception('这是一个异常消息', 1000);
    }
}
