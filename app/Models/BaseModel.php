<?php
/**
 * BaseModel.php
 * Created On 2020/6/18 2:47 下午
 * Create by Retr0
 */

namespace App\Models;

use Carbon\Carbon;
use Closure;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * App\Models\BaseModel
 *
 * 属性声明
 * @property int $id
 * @property string $uuid
 * @property Carbon $created_at
 * @property Carbon $updated_at
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

    public $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public $hidden = ['id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    /**
     * 保持时间与时区一致
     * @param DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    public static function uuid(): string
    {
        return strtoupper(Str::replace('-', '', Str::uuid()->toString()));
    }

    /**
     * 自动写入应用ID 和 平台ID
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $attributes = $model->getAttributes();
            $model->uuid = empty($attributes['uuid']) ? self::uuid() : $attributes['uuid'];
        });
    }
}
