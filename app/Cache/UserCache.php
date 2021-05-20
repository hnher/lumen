<?php
/**
 * Create By PhpStorm
 * User Retr0
 * Date 2020/10/27
 * Time 3:49 下午
 */

namespace App\Cache;

/**
 * Class UserCache
 * @package App\Cache
 */
class UserCache extends Cache
{
    public const USER_TOKEN = 'user_token_%s';

    public const PREFIX = '';

    /**
     * 读取用户token
     * @param $token
     * @return string
     */
    public static function getUserToken($token)
    {
        return self::get(self::getKey(self::USER_TOKEN, $token));
    }

}
