<?php
namespace app\front\controller;
use app\common\model\Typography;
use think\Controller;
use think\Db;
use think\Request;

class SearchController extends Controller 
{
public function index()

    {
         $where   = [];
        $request= input('request');
        $keywordComplex = [];
        $keywords =input('keyword');
        if($keywords){
            $map['name'] = ['like','%'.$keywords.'%'];
            $searchres = db('typography')->where($map)->order('id desc')->paginate($listRows = 3,$simple = false, $config=[
                'query'=>array('keyword'=>$keywords),
            ]);
            $this->assign(array(
                'searchres'=>$searchres,
                'keyword'=>$keywords
            ));
        }else{
            $this->assign(array(
                'searchres'=>null,
                'keyword'=>'暂无数据'
            ));
        }
        return $this->fetch();
    }
}
