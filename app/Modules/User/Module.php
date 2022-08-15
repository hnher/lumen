<?php
/**
 * Module.php
 * Created On 2020/7/21 5:10 下午
 * Create by Retr0
 */

namespace App\Modules\User;

use App\Cache\UserCache;
use App\Exceptions\User\UserNotLoginException;
use App\Facades\Json\Json;

class Module
{
    /**
     * @param string $name
     * @param null $default
     * @return mixed|null
     * @throws UserNotLoginException
     */
    public function get(string $name, $default = null): mixed
    {
        $request = app('request');
        $token = $request->header('authorization');

        if (empty($token)) {
            $token = $request->input('token');
        }

        $user = [];
        if (!empty($token)) {
            $user = Json::decode(UserCache::getUserToken($token));
        }

        $user = collect($user);

        if (collect($user)->isEmpty() && is_null($default)) {
            throw new UserNotLoginException();
        }

        return $user->get($name, $default);
    }
}
