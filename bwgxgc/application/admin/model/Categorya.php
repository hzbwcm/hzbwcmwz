<?php

namespace app\admin\model;

class Categorya extends BaseModel
{
    public static function getCategorya(){
        $categoryas = self::field('caid,caname,cgall')->select();
        return $categoryas;
    }
}
