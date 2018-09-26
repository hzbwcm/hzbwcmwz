<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class ShangpuController extends Controller
{
    //商铺首页
    public function index()
    {
        return $this->fetch();
    }
    //公司简介
    public function gongsijianjie()
    {
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
