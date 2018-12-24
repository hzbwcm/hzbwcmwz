<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class SearchController extends Controller
{
    public function sousuo()
    {
        $keywords= input('keywords');
        if($keywords){
            $map['title']=['like','%'.$keywords.'%'];
            $searchres=db('card')->where($map)->order('id desc')
                ->paginate($listRows = 3,$simple = false,$config =
                [
                    'query'=>array('keywords'=>$keywords),
                ]);

            $this->assign(array(
                'searchres'=>$searchres,
                'keywords'=>$keywords
            ));
        }else{
            $this->assign(array(
                'searchres'=>null,
                'keywords'=>'暂无相关数据'
            ));
        }
        return $this->fetch('search');
    }
}
