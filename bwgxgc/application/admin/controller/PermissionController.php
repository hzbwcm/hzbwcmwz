<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class PermissionController extends Controller
{
    //权限表
    public function quanxianbiao()
    {
        return $this->fetch();
    }
}
