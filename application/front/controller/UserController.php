<?php

namespace app\front\controller;
use app\common\model\Elements as articleModel ;
use app\common\model\Users;
use app\front\controller\Session;
use think\Controller;
use think\Request;

class UserController extends Controller
{
    public function index(){
     

    //显示用户的文章页面
        $data =db('elements')->alias('a')->where('author',session('loginedUser'))->where('delete_time',NULL)->order('id desc')->paginate(6); 
         $this->assign('alist',$data);
         return view();

        return $this->fetch();
    }
    public function  register(){
        //显示注册页面
        return $this->fetch();
    }
    public function  doregister(Request $request){
       
        //处理注册
        $user = new Users();
        //1. 获取表单数据  用
        $user->username = $request->param('username');
        $user->password = md5(input('password'));
        $user->tellphone=input('tellphone');
        //插入数据库库中 save方法

        if($user->save()){
            //注册成功
            return $this->redirect('/front/user/login');
        }else{
            //注册失败，页面跳转 实现页面后退
            return $this->error('注册失败，请重试!');
        }
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
        $condition['username']= input('username');
        $condition['password'] = md5(input('password'));
        // 获取匹配记录
        $manager = Users::where($condition)->find();
        // 判断
        if ($manager) {    // 登录成功
            // 写入session
            session('loginedUser', $manager->username);
            // 跳转
            return $this->redirect( '/front/index');
        } else {
            return $this->error('用户名或密码错误！');
        }
    }
    public function logout(){
        session('loginedUser',null);
        //redirect直接页面跳转，没有消息提示
        return $this->redirect('/front/index');
    }
}