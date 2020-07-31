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

/**
 * Class BaseModel
 * @package App\Models
 * @method static Builder where(Closure|string|array $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static $this create(string $attributes = [])
 * User retr
 */
class BaseModel extends Model
{
    protected $connection = 'master';
}
