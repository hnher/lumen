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
    protected $connection = 'master';

    /**
     * 保持时间与时区一致
     * @param DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }
}
