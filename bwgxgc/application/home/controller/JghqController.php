<?php

namespace app\home\controller;

use think\Controller;
use app\home\model\Banner;

class JghqController extends Controller
{
    public function jghq(){
        $data = Banner::getBanner();
        $this->assign('data',$data);

        return $data;


        
    }
}