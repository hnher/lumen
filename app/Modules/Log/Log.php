<?php
/**
 * Create By PhpStorm
 * User Retr0
 * Date 2020/11/25
 * Time 9:07 上午
 */

namespace App\Modules\Log;

use Illuminate\Support\Facades\Log as LogFacades;

/**
 * Class Log
 * @package App\Modules\Log
 */
class Log
{
    public function info(string $message, array $context = [], string $channel = 'local')
    {
        $context['channel'] = $channel;
        LogFacades::info($message, $context);
    }

    public function error(string $message, array $context = [], string $channel = 'local')
    {
        $context['channel'] = $channel;
        LogFacades::error($message, $context);
    }

    public function warning(string $message, array $context = [], string $channel = 'local')
    {
        $context['channel'] = $channel;
        LogFacades::warning($message, $context);
    }
}
