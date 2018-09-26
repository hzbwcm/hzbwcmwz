<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\behavior\CheckLogin;

class IndexController extends Controller
{
    //后台首页
    public function index()
    {
        return $this->fetch();
    }
    //后台welcome
    public function welcome()
    {
        return $this->fetch();
    }
}
