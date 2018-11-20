<?php

namespace app\home\controller;




use think\Controller;
use app\home\model\Customgood;
use app\home\model\User_person;
use app\home\model\Company_info;
use think\Request;
use think\Session;
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

        $customgood = new customgood();
        $data = $customgood->select();
        $this->assign('data',$data);

        $type = new type();
        $type2 = $type->select();
        $this->assign('type2',$type2);


        return $this->fetch();
    }

    public function Customizing(Request $request)
    {
        $cusid = $request->param('cusid');
        $customgood = new customgood();
        $data = $customgood->where('cus_id',$cusid)->find();

        $this->assign('data',$data);

        $type = new type();
        $type1 = $type->where('type_id',$data['type_id'])->value('type_name');
        $this->assign('type1',$type1);
        return $this->fetch();
    }
}
