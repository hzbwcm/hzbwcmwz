<?php

namespace app\admin\model;

use think\Request;

class Categoryb extends BaseModel
{
    public static function getCategoryb(){
        $caid = Request::instance()->param('id');
        $categorybs = self::where('ca_id','=',$caid)->field('cbid,ca_id,cbname,cgall')->select();
        return $categorybs;
    }
}
