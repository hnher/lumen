<?php
/**
 * Create By PhpStorm
 * User Retr0
 * Date 2020/10/27
 * Time 3:42 下午
 */

namespace App\Properties;

/**
 * Class User
 * @property int $id
 * @property string $name
 * @property string $nickname
 * @property int $appId
 * @property string $uuid
 * @property string $avatar
 * @property int $platform
 * @property string $mobile
 * @package App\Properties
 */
class User extends Property
{
    public $id, $name, $nickname, $appId, $uuid, $avatar, $platform, $mobile;

    /**
     * User constructor.
     * @param int $id
     * @param string $uuid
     * @param string $name
     * @param string $nickname
     * @param int $appId
     * @param string $avatar
     * @param int $platform
     * @param string $mobile
     */
    public function __construct(int $id, string $uuid, string $name, string $nickname, int $appId, string $avatar, int $platform, string $mobile)
    {
        $this->name = $name;
        $this->nickname = $nickname;
        $this->id = $id;
        $this->uuid = $uuid;
        $this->appId = $appId;
        $this->avatar = $avatar;
        $this->platform = $platform;
        $this->mobile = $mobile;
    }
}
