<?php
namespace app\admin\controller;

use app\common\model\Admin;
use think\Controller;
use think\View;

class BaseController extends Controller
{
    public function _initialize()
    {
        View::share('menus', Admin::all());
    }
}
