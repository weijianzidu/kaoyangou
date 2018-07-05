<?php

namespace app\admin\controller;

use app\common\model\Tables;
use think\Controller;
use think\Request;

class TablesController extends Controller
{
    // 数据添加/修改时，所使用的字段名称
    //protected $fields = ['title','content','media_id'];

    public function index()
    {
        // 获取分页数据
        // $rows = News::paginate();
        // // 显示视图
        // $this->assign('rows', $rows);
        // return $this->fetch();
         // 从模型中读取数据
        $indexs = Tables::all();
        // 把数据赋值给视图
        $this->assign('indexs', $indexs);
        // 显示视图
        return $this->fetch();
    }
}
