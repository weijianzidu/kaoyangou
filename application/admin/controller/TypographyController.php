<?php

namespace app\admin\controller;

use app\common\model\Typography as articleModel;
use think\Controller;
use think\Request;

class TypographyController extends Controller
{
    // 数据添加/修改时，所使用的字段名称
    //protected $fields = ['name'];

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        $data =db('typography')->alias('a')->where('delete_time','NULL')->order('id desc')->paginate(6); 
        $this->assign('list',$data);

        $files=db('typography')->alias('a')->where('delete_time','NULL')->where('files','neq','NULL')->order('id desc')->paginate(6);
        $this->assign('flist' ,$files);
     
        //$indexs = Typography::all();
        // 把数据赋值给视图
       // $this->assign('indexs', $indexs);
        // 显示视图
        return $this->fetch();
    }
    //添加院校
    public function add()
    {
        $art=new articleModel;
        if(request()->isPost()){
          $data=input('post.');
         //上传文件
       $files = request()->file('files'); 
       $infos = $files->move(ROOT_PATH . 'public' . DS . 'uploads'); 
        if($infos){
          // //获取当前文章的保存路径
         $urls = $infos->getSaveName();
         $fliep= str_replace("\\","/",$urls);  
         $filepath='uploads/'.$fliep;  
        // //接收当前表单数据
         $data = $_POST;       
         $data['files'] = $filepath;

         $data['create_time']=time();
         if($art->save($data)){
           $this->redirect('typography/index');
         }
           else{
           $this->error('上传失败','typography/index');
         }
        }
    }
        return $this->fetch();

    }


    
  

    //编辑院校
    public function edit()
    {
        $art=new articleModel();
      
        if(request()->isPost()){
          $data=input('post.');
          if($art->update($data)){
            $this->redirect('typography/index');
          }
          else{
            $this->error('修改失败','typography/index');
          }
        }
        $id=input('id');
        $list=db('typography')->where('id',$id)->find();
        $this->assign(array('data'=>$datas,'list'=>$list));
         return view();
        
    }
    //删除院校
    public function del()
    {
            $id=input('id');
           if(articleModel::destroy($id)){
              $this->redirect('typography/index');
           }
           else{
               $this->error('文章删除失败','typography/index');
           }
         }
        
 }
