<?php
namespace app\front\controller;
use app\common\model\Elements as articleModel ;
use think\Controller;
use think\Request;

class IndexController extends Controller
{
    public function index()

    {
        $datas = db('elements')->where('push','1')->where('delete_time','NULL')->order('id desc')->select();
        $this->assign('list',$datas);
        // var_dump($datas);
        // exit;
        return $this->fetch();
    }
    //显示新闻页面

    public function news()
    {

        $id=input('id');
       $list=db('elements')->where('id',$id)->find();
       $datas = db('elements')->where('id',$id)->find();
       $this->assign(array('data'=>$datas,'list'=>$list));
        return view();
    }

    public function author()
    {
        return $this->fetch();
    }
    //考验流程

}
