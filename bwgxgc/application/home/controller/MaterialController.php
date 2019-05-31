<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class MaterialController extends Controller
{
    public function index(){
        return $this->fetch();
    }
}
