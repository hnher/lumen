<?php
/**
 * User.php
 * Created On 2020/7/21 5:10 下午
 * Create by Retr0
 */

namespace App\Modules\User;

use App\Exceptions\User\NotLoginException;
use Exception;
use App\Properties\User as UserProperty;

class User
{
    /**
     * @var UserProperty
     */
    private $user;

    /**
     * User constructor.
     * @throws Exception
     * @throws NotLoginException
     */
    public function __construct()
    {
        $this->user = app('app')->user;

        if (empty($this->user)) {
            throw new NotLoginException();
        }
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function get(string $name)
    {
        return empty($this->user[$name]) ? null : $this->user[$name];
    }
}
