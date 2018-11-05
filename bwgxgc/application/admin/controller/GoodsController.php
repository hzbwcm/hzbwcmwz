<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\behavior\CheckLogin;

class GoodsController extends Controller
{
    public function tiepaishangpingshangchuan()
    {
        $type = ['卫生巾','婴儿纸尿裤','成人纸尿裤','湿纸巾','生活用纸','产妇巾','经期裤','护理垫','宠物垫','乳垫'];
        $new = ['5','6','7','8','9'];
        return $this->fetch();
    }



}