<?php

namespace app\home\model;

class Categoryb extends BaseModel
{
    protected $hidden = ['ca_id','description','update_time','delete_time'];

    public static function getCategoryb(){
        $categorybs = self::field('cbid,cbname,ca_id,cgall')->select();
        return $categorybs;
    }
}
