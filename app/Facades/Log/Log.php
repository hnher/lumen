<?php
/**
 * Create By PhpStorm
 * Module Retr0
 * Date 2020/11/25
 * Time 9:10 上午
 */

namespace App\Facades\Log;

use Illuminate\Support\Facades\Facade;
use App\Modules\Log\Log as LogModule;

/**
 * Class Log
 * @method static void info(string $message, array $context = [], string $channel = 'local')
 * @method static void error(string $message, array $context = [], string $channel = 'local')
 * @method static void warning(string $message, array $context = [], string $channel = 'local')
 * @package App\Facades\Log
 * @see \Illuminate\Log\Logger
 */
class Log extends Facade
{
    protected static function getFacadeAccessor()
    {
        return LogModule::class;
    }
}
