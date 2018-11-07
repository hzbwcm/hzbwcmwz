<?php

namespace app\home\controller;

use app\home\model\Company_info;
use think\Controller;
use think\Request;
use think\Session;
use app\admin\model\Com_pic;

class ShangpuController extends Controller
{

    //商铺首页
    public function index($id)
    {

        Session::set('c_id',$id);
       $c_id=Session::get('c_id');
        $info = Company_info::where('com_id',$c_id)->find();
        $pics = Com_pic::where("com_id" , $c_id )->find();

        $this->assign(['c_id'=>$id,'info'=>$info,'pics'=>$pics]);

        return $this->fetch();
    }
    //公司简介
    public function gongsijianjie()
    {
        $c_id = Session::get('c_id');
        $info = Company_info::where('com_id',$c_id)->find();
        $pics = Com_pic::where("com_id" , $c_id )->find();
        $this->assign([
            'info'=>$info,
            'c_id'=>$c_id,
            'pics'=>$pics
        ]);
        return $this->fetch();
    }
    //产品贴牌
    public function qiyetiepai()
    {
        $c_id=Session::get('c_id');
        $this->assign('c_id',$c_id);
        return $this->fetch();
    }
    //视频展示
    public function shipinzhanshi()
    {
        $c_id=Session::get('c_id');
        $this->assign('c_id',$c_id);
        return $this->fetch();
    }
    //产品展厅
    public function chanpinzhanting()
    {
        $c_id=Session::get('c_id');
        $this->assign('c_id',$c_id);
        return $this->fetch();
    }
    //联系我们
    public function lianxiwomen()
    {
        $c_id = Session::get('c_id');
        $info = Company_info::where('com_id',$c_id)->find();
        $this->assign(['info'=>$info,'c_id'=>$c_id]);
        return $this->fetch();
    }

}
