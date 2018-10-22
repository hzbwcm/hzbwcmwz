<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\home\model\Area;
use app\home\model\Pro_type;

class CustomController extends Controller
{

    public function Custom()
    {
        $info = Area::where('Pid',0)->select();

        $type = Pro_type::select();
        $this->assign([
            'info'  => $info,
            'type' => $type
        ]);


        return $this->fetch();
    }

    public function get_area()
    {
        //地区

    }

}
