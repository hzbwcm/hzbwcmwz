<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class MarketController extends Controller
{
    //价格行情分类管理
    public function marketclassification()
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
}
