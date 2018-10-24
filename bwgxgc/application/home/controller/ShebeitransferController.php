<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\home\model\Area;
class ShebeitransferController extends Controller
{
    //设备转让
    public function shebeitransfer()
    {
        $info = Area::where('Pid',0)->select();
        $this->assign('info',$info);
        return $this->fetch();
    }
    //设备转让详情
    public function shebeizhuanrang()
    {
        return $this->fetch();
    }
}
