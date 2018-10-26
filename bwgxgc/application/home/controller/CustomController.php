<?php

namespace app\home\controller;




use think\Controller;
use think\Request;
use app\home\model\Area;
use app\home\model\Type;
use app\home\model\Custom;

class CustomController extends Controller
{

    public function Custom()
    {
        $info = Area::where('Pid',0)->select();

        $type = Type::select();
        $this->assign([
            'info'  => $info,
            'type' => $type
        ]);


        return $this->fetch();
    }

    public function Customizing()
    {
        return $this->fetch();
    }
}
