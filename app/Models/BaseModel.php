<?php
/**
 * BaseModel.php
 * Created On 2020/6/18 2:47 下午
 * Create by Retr0
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Closure;
use DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\BaseModel
 *
 * 属性声明
 * @property int $id
 * @property string $uuid
 * @property int $createdTime
 * @property int $updatedTime
 * @property int|null $deletedTime
 *
 * 函数声明
 * @method static Builder|BaseModel newModelQuery()
 * @method static Builder|BaseModel newQuery()
 * @method static Builder|BaseModel query()
 * @method static Builder where(Closure|string|array $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static $this create(string $attributes = [])
 * @mixin Model
 */
class BaseModel extends Model
{
    use SoftDeletes;

    protected $connection = 'master';

    public const CREATED_AT = 'createdTime';

    public const UPDATED_AT = 'updatedTime';

    public const DELETED_AT = 'deletedTime';

    protected $dateFormat = 'U';

    public $guarded = ['id', 'createdTime', 'updatedTime', 'deletedTime'];

    public $hidden = ['id', 'appId', 'platformId', 'userId', 'sellerId', 'deletedTime', 'unitId', 'activityId', 'planId', 'couponId', 'partnerId', 'paymentId', 'orderId', 'billId'];

    protected $casts = [
        'createdTime' => 'datetime:Y-m-d H:i:s',
        'updatedTime' => 'datetime:Y-m-d H:i:s',
        'deletedTime' => 'datetime:Y-m-d H:i:s',
        'startTime' => 'datetime:Y-m-d H:i:s',
        'endTime' => 'datetime:Y-m-d H:i:s',
        'receiveTime' => 'datetime:Y-m-d H:i:s',
        'expireTime' => 'datetime:Y-m-d H:i:s',
        'useTime' => 'datetime:Y-m-d H:i:s',
        'verifyTime' => 'datetime:Y-m-d H:i:s',
        'paidTime' => 'datetime:Y-m-d H:i:s',
        'refundTime' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * 保持时间与时区一致
     * @param DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    public static function uuid()
    {
        return base_convert(rand(1000, 9999) . date('YmdHis') . rand(1000, 9999), 10, 36);
    }
    /**
     * 自动写入应用ID 和 平台ID
     */
    public static function boot()
    {
        parent::boot();
        self::creating( function ($model) {
            $attributes = $model->getAttributes();
            $model->appId = empty($attributes['appId']) ? User::get('appId') : $attributes['appId'];
            $model->platformId = empty($attributes['platformId']) ? User::get('platform') : $attributes['platformId'];
            $model->uuid = empty($attributes['uuid']) ? self::uuid() : $attributes['uuid'];
        });
    }
}
