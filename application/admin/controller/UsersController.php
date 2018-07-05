<?php

namespace app\admin\controller;

use app\common\model\Users;
use think\Controller;
use think\Request;

class UsersController extends Controller
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
        $indexs = Users::all();
        // 把数据赋值给视图
        $this->assign('indexs', $indexs);

        //
        $data =db('users')->alias('a')->where($where)->order('id desc')->paginate(3); 
        $this->assign('user',$data);
        return view();
       
        // 显示视图
        //return $this->fetch();

    }
    public function show(){
        $data =db('users')->alias('a')->where($where)->order('id desc')->paginate(3); 
        $this->assign('user',$data);
        return view();
       }
}
