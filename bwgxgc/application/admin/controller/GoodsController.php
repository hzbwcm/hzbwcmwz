<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\behavior\CheckLogin;

class GoodsController extends Controller
{
    //管理员表
        public function guanliyuan()
        {
            return $this->fetch();
        }
    //角色表
        public function juesebiao()
        {
            return $this->fetch();
        }
    //权限表
        public function quanxianbiao()
        {
            return $this->fetch();
        }
}