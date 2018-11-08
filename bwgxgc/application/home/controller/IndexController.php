<?php
namespace app\home\controller;

use think\Controller;
use app\home\model\Area;
class IndexController extends Controller
{
    //前台首页
    public function index()
    {
        return $this->fetch();
    }
    //前台页脚
    public function foot_base()
    {
        return $this->fetch();
    }

    //网络批发
    public function wlpf()
    {
        return $this->fetch();
    }

    //杂志
    public function magazine()
    {
        return $this->fetch();
    }

    //收藏夹
    public function shoucangjia()
    {
        return $this->fetch();
    }
    //收藏夹
    public function sousuo()
    {
        return $this->fetch();
    }

}