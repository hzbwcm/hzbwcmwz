<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\home\model\Area;
use app\home\model\Pro_type;

class InspectionController extends Controller
{
    //优选验厂
    public function inspection()
    {   //地区
        $info = Area::where('Pid',0)->select();
        $type = Pro_type::where('type_pid',0)->select();
        $this->assign([
            'info'  => $info,
            'type' => $type
        ]);
        return $this->fetch();
    }
}
