<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use think\Session;

class ShangpuController extends Controller
{

    //商铺首页
    public function index($id)
    {

        Session::set('c_id',$id);
        $c_id=Session::get('c_id');


        return $this->fetch();
    }
    //公司简介
    public function gongsijianjie()
    {
        $c_id = Session::get('c_id');
        return $this->fetch();
    }
    //产品贴牌
    public function qiyetiepai()
    {
        return $this->fetch();
    }
    //视频展示
    public function shipinzhanshi()
    {
        return $this->fetch();
    }
    //产品展厅
    public function chanpinzhanting()
    {
        return $this->fetch();
    }
    //联系我们
    public function lianxiwomen()
    {
        return $this->fetch();
    }

}
