<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class MarketController extends Controller
{
    public function marketclassification()
    {
        return $this->fetch();
   }
   public function addmarketone()
    {
        return $this->fetch();
   }
   public function addmarkettwo()
    {
        return $this->fetch();
   }
}
