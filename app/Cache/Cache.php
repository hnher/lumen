<?php
/**
 * Redis 缓存基类, 所有缓存应继承本类
 * BaseCache.php
 * Created On 2020/2/17 6:39 下午
 * Create by retr
 */

namespace App\Cache;

use App\Facades\Redis\Redis;

/**
 * Class RedisCache
 * @package App\Cache
 * User retr
 */
class Cache extends Redis
{
    //请在此处声明常用时间，如一小时、一天、一周、一个月、一年等！

    //一分钟
    const ONE_MINUTE = 60;

    //一小时
    const ONE_HOUR = 3600;

    //一天
    const ONE_DAY = self::ONE_HOUR * 24;

    //一周
    const ONE_WEEK = self::ONE_DAY * 7;

    //一个月
    const ONE_MONTH = self::ONE_DAY * 30;

    //一年
    const ONE_YEAR = self::ONE_DAY * 365;

    const FOREVER = -1;

    /**
     * PREFIX 缓存前缀
     * 不同的服务可能需要不同的前缀需要在子类中重写
     */
    const PREFIX = '';

    /**
     * 用于格式化每个 Key 序列
     * @param string $str
     * @param mixed ...$keys
     * @return string
     * @example self::getKey('abc_%s_%s', 1, 2)
     */
    public static function getKey(string $str, ...$keys)
    {
        return vsprintf(static::PREFIX . $str, $keys);
    }

    /**
     * 为mGet做准备,变成数组键值
     * @param string $key 键值
     * @param array $arr 匹配的数组队
     * @return array
     */
    public static function getMoreKey($key, $arr)
    {
        $tmpArr = [];
        foreach ($arr as $v) {
            if (!is_array($v)) {
                $v = [$v];
            }

            $tmpArr['keyGroup'][] = call_user_func_array('self::getKey', array_merge([$key], $v));
        }
        $tmpArr['idGroup'] = $arr;
        return $tmpArr;
    }

    /**
     * 改写 原有的 hSet 逻辑
     * 此处每次写入值都会更新过期时间。请注意！！！
     * @param string $key
     * @param string $hashKey
     * @param string $value
     * @param int $ttl
     * @return bool | int
     */
    public static function hSet(string $key, string $hashKey, string $value, int $ttl = self::FOREVER)
    {
        $res = parent::hSet($key, $hashKey, $value);
        self::expire($key, $ttl);
        return $res;
    }

    /**
     * 改写原有逻辑
     * 此处每次写入值都会更新过期时间。请注意！！！
     * @param string $key
     * @param float $value
     * @param string $member
     * @param int $ttl
     * @return float
     */
    public static function zIncrBy(string $key, float $value, string $member, int $ttl = self::FOREVER)
    {
        $res = parent::zIncrBy($key, $value, $member);
        self::expire($key, $ttl);
        return $res;
    }

    /**
     * 此处重写 incr 逻辑
     * @param string $key
     * @param int $ttl
     * @return int
     */
    public static function incr(string $key, int $ttl = self::FOREVER)
    {
        $res = parent::incr($key);
        self::expire($key, $ttl);
        return $res;
    }

    /**
     * 此处重写 incrBy 逻辑
     * @param string $key
     * @param int $value
     * @param int $ttl
     * @return int
     */
    public static function incrBy(string $key, int $value, int $ttl = self::FOREVER)
    {
        $res = parent::incrBy($key, $value);
        self::expire($key, $ttl);
        return $res;
    }

    /**
     * 此处重写 incrByFloat 逻辑
     * @param string $key
     * @param float $increment
     * @param int $ttl
     * @return float
     */
    public static function incrByFloat(string $key, float $increment, int $ttl = self::FOREVER)
    {
        $res = parent::incrByFloat($key, $increment);
        self::expire($key, $ttl);
        return $res;
    }

    /**
     * 此处重写 decr 逻辑
     * @param string $key
     * @param int $ttl
     * @return int
     */
    public static function decr(string $key, int $ttl = self::FOREVER)
    {
        $res = parent::decr($key);
        self::expire($key, $ttl);
        return $res;
    }

    /**
     * 此处重写 decrBy 逻辑
     * @param string $key
     * @param int $value
     * @param int $ttl
     * @return int
     */
    public static function decrBy(string $key, int $value, int $ttl = self::FOREVER)
    {
        $res = parent::decrBy($key, $value);
        self::expire($key, $ttl);
        return $res;
    }

    /**
     * 此处重写 hIncrBy逻辑
     * @param string $key
     * @param string $hashKey
     * @param int $value
     * @param int $ttl
     * @return int
     */
    public static function hIncrBy(string $key, string $hashKey, int $value, int $ttl = self::FOREVER)
    {
        $res = parent::hIncrBy($key, $hashKey, $value);
        self::expire($key, $ttl);
        return $res;
    }

    /**
     * 此处重写 hIncrByFloat 逻辑
     * @param string $key
     * @param string $field
     * @param float $increment
     * @param int $ttl
     * @return float
     */
    public static function hIncrByFloat(string $key, string $field, float $increment, int $ttl = self::FOREVER)
    {
        $res = parent::hIncrByFloat($key, $field, $increment);
        self::expire($key, $ttl);
        return $res;
    }

    /**
     * 改写原有逻辑
     * 此处每次写入值都会更新过期时间。请注意！！！
     * @param string $key
     * @param array $values
     * @param int $ttl
     * @return mixed
     */
    public static function rPush(string $key, array $values, int $ttl = self::FOREVER)
    {
        $res = parent::rPush($key, ...$values);
        self::expire($key, $ttl);
        return $res;
    }

    /**
     * 此处重写 lPush 逻辑
     * @param string $key
     * @param array $values
     * @param int $ttl
     * @return bool|int
     */
    public static function lPush(string $key, array $values, int $ttl = self::FOREVER)
    {
        $res = parent::lPush($key, ...$values);
        self::expire($key, $ttl);
        return $res;
    }

    /**
     * 此处重写 sAdd 逻辑
     * @param string $key
     * @param array $values
     * @param int $ttl
     * @return bool|int
     */
    public static function sAdd(string $key, array $values, int $ttl = self::FOREVER)
    {
        $res = parent::sAdd($key, ...$values);
        self::expire($key, $ttl);
        return $res;
    }

    /**
     * 批量获取,自动根据传进来的ID排序
     * @param array $array 包含idGroup(键),keyGroup2个组
     * @return array
     */
    public static function mGet(array $array)
    {
        $list = parent::mget($array['keyGroup']);
        foreach ($list as $k => $v) {
            $list[$k] = $v;
        }
        return array_combine($array['idGroup'], $list);
    }

    /**
     * 批量删除 Hash 子 key
     * @param string $key Hash Key 名称
     * @param array $subKeys Hash 子Key 名称
     * @return int | bool
     */
    public static function hMDel(string $key, array $subKeys = [])
    {
        if (count($subKeys) == 0) {
            return 0;
        }

        return parent::hDel($key, $subKeys[0], ...$subKeys);
    }
}
