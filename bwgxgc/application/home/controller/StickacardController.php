<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class StickacardController extends Controller
{
    public function stickacard()
    {
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
