<?php
/**
 * Scheduler.php
 * Created On 2020/6/19 4:49 下午
 * Create by Retr0
 */

namespace App\Facades\Scheduler;

use App\Modules\Scheduler\Messages\Message;
use App\Modules\Scheduler\Scheduler as SchedulerModule;
use Illuminate\Support\Facades\Facade;

/**
 * Class Scheduler
 * 发生消息
 * @method static mixed sendMessage(Message $message, string $topic = '', string $instanceId = '')
 * @package App\Facades\Scheduler
 * Module retr
 */
class Scheduler extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SchedulerModule::class;
    }
}
