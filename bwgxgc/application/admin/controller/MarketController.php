<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class MarketController extends Controller
{
    //价格行情分类管理   列表
    public function marketclassification()
    {
        return $this->fetch();
    }
    //价格行情列表
    public function pricelist()
    {
        return $this->fetch();
    }
    //热点行情列表
    public function hotlist()
    {
        return $this->fetch();
    }
    //价格行情一级分类添加
    public function addmarketone()
    {
        return $this->fetch();
    }
    //价格行情二级分类添加
    public function addmarkettwo()
    {
        return $this->fetch();
    }
    //发布热点行情
    public function publishhotmarket()
    {
        return $this->fetch();
    }
    //发布价格行情
    public function publishmarket()
    {
        return $this->fetch();
    }
    //修改热点行情
    public function updatehotmarket()
    {
        return $this->fetch();
    }
    //修改价格行情
    public function updatemarket()
    {
        return $this->fetch();
    }
}
