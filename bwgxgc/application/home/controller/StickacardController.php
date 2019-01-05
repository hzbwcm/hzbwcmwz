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
        $info = Card::where('id','>',0)->select();
        $info_obj=[];
        for ($i=0;$i < sizeof($type);$i++){
            $info_arr=[];
            for ($j=0;$j < sizeof($info);$j++){
                if($type[$i]['type_name']==$info[$j]['type']){
                    array_push($info_arr,$info[$j]);
                }
            }
            $info_obj[$type[$i]['type_name']] = $info_arr;
        }

        $this->assign([
            'type'=>$type,
            'info'=>$info_obj
        ]);
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
    public function tiepaigengduo($ypeame,$yped)
    {
        $tname =$ypeame;
        $tid = $yped;
        $info = Type::where('type_pid',0)->select();
        $tinfo = Type::where('type_pid',$tid)->select();
        $cinfo = Card::where('type',$tname)->order('id desc')->paginate(15,false,['query'=>['ypeame'=>$tname,'yped'=>$tid]]);
        $pagelist = $cinfo->render();
        $this->assign('pagelist',$pagelist);
        $type = Type::select();

        $this->assign([
            'info' => $info,
            'cinfo'  => $cinfo,
            'type' => $type,
            'tinfo'=>$tinfo,
            'tname'=>$tname
        ]);

        return $this->fetch();
    }
}
