<?php

namespace app\admin\controller;
use think\Controller;
class SearchController extends  Controller
{
    public function index()
    {
        $keywords=input('name');
        if($keywords){
            $map['name']=['like','%'.$keywords.'%'];
            $searchres=db('typography')->where($map)->order('id desc')->paginate($listRows=3,$simple=false,$config=
            [
                'query'=>array('keywords'=>$keywords),
            ]);
           $this->assign(array(
               'searchres'=>$searchers,
               'keywords'=>$keywords
           )) ;
        }else{
            $this->assign(array(
                'searchres'=>null,
               'keywords'=>'暂无数据'
            ));
        }
        return $this->fetch('search');
    }
}
