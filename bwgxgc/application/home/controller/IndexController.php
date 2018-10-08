<?php
namespace app\home\controller;

use think\Controller;
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
    //前台产品定制
    public function custom()
    {
        return $this->fetch();
    }
    //贴牌专区
    public function stickacard()
    {
        return $this->fetch();
    }
    //贴牌详情
    public function tiepaixiangqing()
    {
        return $this->fetch();
    }
    //贴牌更多
    public function tiepaigengduo()
    {
        return $this->fetch();
    }
    //优选验厂
    public function inspection()
    {
        return $this->fetch();
    }
    //设备转让
    public function shebeitransfer()
    {
        return $this->fetch();
    }
    //设备转让详情
    public function shebeizhuanrang()
    {
        return $this->fetch();
    }
    //跟单专家
    public function documentary()
    {
        return $this->fetch();
    }
    //网络批发
    public function wlpf()
    {
        return $this->fetch();
    }
    //产品定制详情
    public function customizing()
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
}