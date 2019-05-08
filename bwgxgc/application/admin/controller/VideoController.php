<?php

namespace app\admin\controller;

use think\Controller;

class VideoController extends Controller
{
    public function VideoUp()
    {
        return $this->fetch();
    }
}