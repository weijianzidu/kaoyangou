<?php

namespace app\admin\controller;

use app\common\model\Panels ;
use think\Controller;
use think\Request;

class PanelsController extends Controller
{
    public function index()
    {
        // // 获取分页数据
        // $rows = Menu::paginate();
        // // 显示视图
        // $this->assign('rows', $rows);
        // return $this->fetch();
         // 从模型中读取数据
        $indexs = Panels::all();
        // 把数据赋值给视图
        $this->assign('indexs', $indexs);
        // 显示视图
        return $this->fetch();
        //显示视图
       $data =db('elements')->alias('a')->where($where)->order('id desc')->paginate(3); 
         $this->assign('list',$data);
         return view();
    
    }
}
