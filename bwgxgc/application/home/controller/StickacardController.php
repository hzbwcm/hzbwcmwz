<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\home\model\Pro_type;

class StickacardController extends Controller
{
    public function stickacard()
    {
        $type = Pro_type::where('pid',0)->select();
        $this->assign('type',$type);
        return $this->fetch();
    }
    //贴牌详情
    public function tiepaixiangqing()
    {
        return $this->fetch();
    }
    //贴牌更多
    public function tiepaigengduo()
    {
        return $this->fetch();
    }
}
