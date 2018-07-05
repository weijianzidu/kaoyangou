<?php
namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class Manager extends Model
{
    use SoftDelete;
}
