<?php
/**
 * Created by PhpStorm.
 * File: BaseException.php
 * Project: lumen
 * User: hnher
 * Year: 2021-03-04 16:55:47
 * Date: 2021/3/4
 * Time: 16:55
 */

namespace App\Exceptions;

use Exception;

class BaseException extends Exception
{
    public const ERRORS = [
        'message' => '程序发生异常',
        'code' => 10000
    ];

    public function __construct()
    {
        parent::__construct(static::ERRORS['message'], static::ERRORS['code'], null);
    }
}
