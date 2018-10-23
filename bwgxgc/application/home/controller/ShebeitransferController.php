<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class ShebeitransferController extends Controller
{
    //设备转让
    public function shebeitransfer()
    {
        return $this->fetch();
    }
    //设备转让详情
    public function shebeizhuanrang()
    {
        return $this->fetch();
    }
}
