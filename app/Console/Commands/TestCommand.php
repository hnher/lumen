<?php
/**
 * TestCommand.php
 * Created On 2020/6/18 2:42 下午
 * Create by Retr0
 */

namespace App\Console\Commands;

use App\Cache\RedisCache;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'Test:Test';

    protected $description = '测试使用脚本';

    /**
     * 业务处理
     */
    public function handle()
    {
        $u = RedisCache::set('user', 1);

        //$u = RedisCache::ttl('user');
        dd(RedisCache::ttl('user'));
    }
}
