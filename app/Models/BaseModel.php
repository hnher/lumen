<?php
/**
 * BaseModel.php
 * Created On 2020/6/18 2:47 下午
 * Create by Retr0
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $connection = 'master';
}
