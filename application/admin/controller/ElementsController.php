<?php

namespace app\admin\controller;
use app\common\model\Elements as articleModel ;
use think\Controller;
use think\Request;

class ElementsController extends Controller
{
     public function index()
    {
    $art=new articleModel;
    if(request()->isPost()){
       $data=input('post.');
      
       $file = request()->file('pic');       
        
 //移动到框架应用根目录/public/uploads/ 目录下 
     $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'); 
     if ($info) {
     //获取当前保存路径
     $url = $info->getSaveName();
     $imgp= str_replace("\\","/",$url);  
     $imgpath='uploads/'.$imgp;  
     //接收当前表单数据
     $data = $_POST;       
     $data['pic'] = $imgpath;
     
       $data['time']=time();
      if($art->save($data)){
        $this->redirect('elements/list');
      }
        else{
        $this->error('文章上传失败','elements/list');
      }
    }
   
     }
     return $this->fetch();
    } 

     public function list()
     {
         $data =db('elements')->alias('a')->where('delete_time','NULL')->order('id desc')->paginate(6); 
         $this->assign('list',$data);
         return view();
     }
     public function show(){
      $data =db('elements')->alias('a')->where($where)->order('id desc')->paginate('1'); 
      $this->assign('list',$data);
      return $this->fetch();
     }

     public function edit()
    {
      $art=new articleModel();
      
      if(request()->isPost()){
        $data=input('post.');
        if($art->update($data)){
          $this->redirect('elements/list');
        }
        else{
          $this->error('文章修改失败','elements/list');
        }
      }
      $id=input('id');
      $list=db('elements')->where('id',$id)->find();
      $this->assign(array('data'=>$datas,'list'=>$list));
       return view();
    }

    public function del(){
       $id=input('id');
      if(articleModel::destroy($id)){
         $this->redirect('elements/list');
      }
      else{
          $this->error('文章删除失败','elements/list');
      }
    }
    
}




   