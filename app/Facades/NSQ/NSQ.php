<?php

namespace App\Facades\NSQ;

use App\Modules\NSQ\NSQ as NSQModule;
use Illuminate\Support\Facades\Facade;

/**
 * @method static bool pub(array $message, string $topic, int $delay = 0, string $unit = 's')
 */
class NSQ extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return NSQModule::class;
    }
}
