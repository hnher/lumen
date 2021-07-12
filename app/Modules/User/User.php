<?php
/**
 * Created by PhpStorm.
 * File: User.php
 * Project: lumen
 * User: hnher
 * DateTime: 2021-06-02 17:30:51
 */

namespace App\Modules\User;

use Illuminate\Support\Facades\Facade;

/**
 * Class User
 * @method static mixed get(string $name)
 * @package App\Modules\User
 */
class User extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'user';
    }
}
