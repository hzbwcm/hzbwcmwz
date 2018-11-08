<?php

namespace app\home\controller;

use app\admin\model\Com_pic;
use think\Controller;
use think\Request;
use app\home\model\Area;
use app\home\model\Type;
use app\home\model\Company_info;

class InspectionController extends Controller
{
    //优选验厂
    public function inspection()
    {   //地区
        $info = Area::where('Pid',0)->select();
        $type = Type::where('type_pid',0)->select();
        $com = Company_info::where('role_id',30)->select();
        //$com1 = Company_info::where('role_id',30)->column('com_id');
        for($x=0;$x<count($com);$x++)
        {

            $pics = Com_pic::where('com_id',$com[$x]['com_id'])->find();
            $com[$x]['pic6'] =$pics['pic6'];
        }


        $this->assign([
            'info'  => $info,
            'type' => $type,
            'com' => $com,

        ]);
        return $this->fetch();
    }
}
