<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\behavior\CheckLogin;

class RoleController extends Controller
{
    //角色表
    public function juesebiao()
    {
        return $this->fetch();
    }
}
