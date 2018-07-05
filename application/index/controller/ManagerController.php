<?php
namespace app\index\controller;

use app\common\model\Admin;
use think\Controller;
use think\Request;

class ManagerController extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function login()
    {
        return $this->fetch();
    }

    public function dologin()
    {
        
        // 构造条件
        $condition = [];
        // 获取表单数据
        $condition['username'] = input('username');
        $condition['password'] = input('password');
        // 获取匹配记录
        $manager = Admin::where($condition)->find();
        // 判断
        if ($manager) {    // 登录成功
            // 写入session
            session('loginedUser', $manager->username);
            // 跳转
            return $this->redirect( '/admin/admin/list');
        } else {
            return $this->error('用户名或密码错误！');
        }
    }

     public function logout()
     {
         session('loginedUser', null);
         return $this->redirect('/');
     }

    
  
}
