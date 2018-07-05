<?php
namespace app\front\controller;
use app\common\model\Typography as articleModel ;
use app\common\model\Typography;
use think\Controller;
use think\Request;

class InforController extends Controller 
{
    //显示专业页面

    public function major()
    {
        $data =db('typography')->alias('a')->where('delete_time','NULL')->where('files','neq','NULL')->order('id desc')->paginate(6); 
        $this->assign('afile',$data);
        return $this->fetch();
    }
    //显示学校界面

    public function school()
    {
        $data =db('typography')->alias('a')->where('delete_time','NULL')->order('id desc')->paginate(6); 
        $this->assign('sfile',$data);
       
        return $this->fetch();

    }
    //显示详细学校页面
    public function sinfo()
    {
        //id值最好从前一页的Ajax接口中获取

   
       $id=input('id');
       $list=db('typography')->where('id',$id)->find();
       $datas = db('typography')->where('id',$id)->find();
       $this->assign(array('data'=>$datas,'list'=>$list));
        return view();
       


    }


   //下载文件
      //下载文件
  //下载文件
  public function download(){
    $id=input('id');
    $file=db('typography')->find($id);
    $file_name=$file['files'];
    $file_dir=ROOT_PATH.'public'.DS."/";
    echo $file_dir.$file_name;
    $file1=fopen($file_dir.$file_name,'r'); //打开文件
         //输入文件标签 
    header("Content-type: application/octet-stream");  
    header("Accept-Ranges: bytes");  
    header("Accept-Length: ".filesize($file_dir.$file_name));  
    header("Content-Disposition: attachment; filename=".$file_name);  
    ob_clean();
    flush(); 
    //输出文件内容  
    echo fread($file1,filesize($file_dir.$file_name));  
    fclose($file1);
      
}


// public function download(){
//     $id=input('id');
//     $file=db('typography')->find($id);
//     $file_name=$file['files'];
//     $file_dir=ROOT_PATH.'public'.DS."/";
//     echo $file_dir.$file_name;
//     $file1=fopen($file_dir.$file_name,'r'); //打开文件
//          //输入文件标签 
//     header("Content-type: application/octet-stream");  
//     header("Accept-Ranges: bytes");  
//     header("Accept-Length: ".filesize($file_dir.$file_name));  
//     header("Content-Disposition: attachment; filename=".$file_name);  
//     ob_clean();
//     flush(); 
//     //输出文件内容  
//     echo fread($file1,filesize($file_dir.$file_name));  
//     fclose($file1);
//     exit();  
// }
}
