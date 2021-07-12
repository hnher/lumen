<?php
/**
 * Module.php
 * Created On 2020/7/21 5:10 下午
 * Create by Retr0
 */

namespace App\Modules\User;

use App\Cache\UserCache;
use App\Exceptions\User\NotLoginException;
use App\Facades\Json\Json;
use Exception;
use App\Properties\User as UserProperty;

class Module
{
    /**
     * @var UserProperty
     */
    private $user;

    /**
     * Module constructor.
     * @throws Exception
     * @throws NotLoginException
     */
    public function __construct()
    {
        $token = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if (empty($token)) {
            $token = $_GET['token'] ?? '';
        }

        $user = null;
        if (!empty($token)) {
            $user = Json::decode(UserCache::getUserToken($token));
        }

        $this->user = $user;

        if (empty($this->user) && $_SERVER['PHP_SELF'] !== 'artisan') {
            throw new NotLoginException();
        }
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function get(string $name)
    {
        if ($_SERVER['PHP_SELF'] === 'artisan') {
            return null;
        }
        return empty($this->user[$name]) ? null : $this->user[$name];
    }
}
