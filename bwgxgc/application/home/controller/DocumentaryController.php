<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class DocumentaryController extends Controller
{
    //跟单专家
    public function documentary()
    {
        return $this->fetch();
    }
}
