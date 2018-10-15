<?php

namespace app\admin\controller;

use app\admin\model\Role;
use think\Controller;
use think\Request;
use app\admin\behavior\CheckLogin;

class RoleController extends Controller
{
    //角色表
    public function juesebiao()
    {
        $info = Role::select();
        $this -> assign('info',$info);
        return $this->fetch();
    }
}
