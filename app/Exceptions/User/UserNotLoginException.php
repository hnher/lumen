<?php
/**
 * Created by PhpStorm.
 * File: NotLoginException.php
 * Project: lumen
 * Module: hnher
 * DateTime: 2021-04-26 14:11:51
 */

namespace App\Exceptions\User;


use App\Constants\ErrorConstant;
use App\Exceptions\BaseException;

class UserNotLoginException extends BaseException
{
    public const ERRORS = ErrorConstant::NOT_LOGIN;
}
