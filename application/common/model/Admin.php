<?php
namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class Admin extends Model
{
    use SoftDelete;
}
