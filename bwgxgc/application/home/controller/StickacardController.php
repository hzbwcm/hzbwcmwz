<?php

namespace app\home\controller;

use app\home\model\Card;
use app\home\model\Company_info;
use app\home\model\Type;
use think\Controller;
use think\Request;
use think\Session;


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
    public function tiepaixiangqing($id)
    {
        Session::set('id',$id);
        $c_id=Session::get('id');
        $c_info = Card::where('id',$c_id)->find();
        $tel = Company_info::where('com_id',$c_info['com_id'])->column('tel');

        $this->assign(['info'=>$c_info,
                        'tel'=>$tel
            ]);
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
