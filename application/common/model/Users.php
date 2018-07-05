<?php
namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class Users extends Model
{
    use SoftDelete;
}
