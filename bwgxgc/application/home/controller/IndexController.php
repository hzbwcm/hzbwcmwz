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

    //个人中心
    public function usercenter()
    {
        return $this->fetch();
    }
    //个人中心框
    public function accountcenter()
    {
        return $this->fetch();
    }
    //发布信息
    public function fabuxinxi()
    {
        return $this->fetch();
    }
    //信息管理首页
    public function xinxiguanlishouye()
    {
        return $this->fetch();
    }
    //信息管理
    public function xinxiguanli()
    {
        return $this->fetch();
    }
    //收藏夹
    public function shoucangjia()
    {
        return $this->fetch();
    }

}