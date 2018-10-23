<?php

namespace app\home\controller;

use think\Controller;
use think\Request;


class CustomizingController extends Controller
{
    //产品定制详情
    public function customizing()
    {
        return $this->fetch();
    }
}
