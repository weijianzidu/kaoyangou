<?php
namespace app\front\controller;
use app\common\model\Elements as articleModel ;
use think\Controller;
use think\Request;

class ArticleController extends Controller
{
//   public function index()
//     {
//     $art=new articleModel;
//     if(request()->isPost()){
//        $data=input('post.');
      
//        $file = request()->file('pic');       
        
//  //移动到框架应用根目录/public/uploads/ 目录下 
//      $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'); 
//      if ($info) {
//      //获取当前保存路径
//      $url = $info->getSaveName();
//      $imgp= str_replace("\\","/",$url);  
//      $imgpath='uploads/'.$imgp;  
//      //接收当前表单数据
//      $data = $_POST;       
//      $data['pic'] = $imgpath;
     
//        $data['time']=time();
//       if($art->save($data)){
//         $this->redirect('/front/user/index');
//       }
//         else{
//         $this->error('文章上传失败','elements/list');
//       }
//     }
   
//      }
//      return $this->fetch();
//     } 

    //文章显示页

  public function show()
  {
    $id=input('id');
    $data =db('elements')->alias('a')->where('id',$id)->order('id desc')->paginate('1'); 
      $this->assign('list',$data);
      return $this->fetch();
  }
  
    public function index()
    {
    $art=new articleModel;
    if(request()->isPost()){
       $data=input('post.');
       $data['time']=time();
      if($art->save($data)){
        $this->redirect('/front/user/index');
              }
          else{
             $this->error('文章上传失败','/front/user/index');
             }
        }
      return $this->fetch();
     } 

     public function edit()
     {
       $art=new articleModel();
       
       if(request()->isPost()){
         $data=input('post.');
         if($art->update($data)){
           $this->redirect('user/index');
         }
         else{
           $this->error('文章修改失败','user/index');
         }
       }
       $id=input('id');
       $list=db('elements')->where('id',$id)->find();
       $datas = db('elements')->where('id',$id)->find();
       $this->assign(array('data'=>$datas,'list'=>$list));
        return view();
     }
 
     public function del(){
        $id=input('id');
       if(articleModel::destroy($id)){
          $this->redirect('user/index');
       }
       else{
           $this->error('文章删除失败','user/index');
       }
     }
     
}