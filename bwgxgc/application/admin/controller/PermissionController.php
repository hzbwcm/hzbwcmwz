<?php

namespace app\admin\controller;

use app\admin\model\Permission;
use think\Controller;
use think\Request;

class PermissionController extends Controller
{
    //权限表
    public function index()
    {
        $info = Permission::select();
        $arr = [];
        foreach ($info as $v){
            $arr[] = $v->toArray();
        }
        $shuju = generateTree($arr);
        $this -> assign('info',$shuju);
        return $this->fetch();
    }
}
