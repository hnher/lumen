<?php
/**
 * Json.php
 * Created On 2020/6/18 3:36 下午
 * Create by Retr0
 */

namespace App\Facades\Json;

use Illuminate\Support\Facades\Facade;
use App\Modules\Json\Json as JsonModule;

/**
 * Class Json
 * @method static encode(mixed $obj)
 * @method static decode(mixed $str)
 * @package App\Facades\Json
 * Module retr
 */
class Json extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return JsonModule::class;
    }
}
