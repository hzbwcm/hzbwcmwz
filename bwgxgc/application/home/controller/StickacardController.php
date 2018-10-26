<?php

namespace app\home\controller;

use app\home\model\Type;
use think\Controller;
use think\Request;



use app\home\model\Area;

class StickacardController extends Controller
{
    public function stickacard()
    {



        $type = Type::where('type_pid',0)->select();

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
        $info = Area::where('Pid',0)->select();

        $type = Type::select();
        $this->assign([
            'info'  => $info,
            'type' => $type
        ]);

        return $this->fetch();
    }
}
