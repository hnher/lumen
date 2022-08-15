<?php

namespace App\Facades\NSQ;

use Illuminate\Support\Facades\Facade;
use App\Modules\NSQ\NSQ as NSQModule;

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
