<?php

namespace app\admin\controller;

use app\admin\model\Attribute;
use think\Controller;
use think\Request;

class AttributeController extends Controller
{
    public function index(){
        return $this->fetch();
    }
}
