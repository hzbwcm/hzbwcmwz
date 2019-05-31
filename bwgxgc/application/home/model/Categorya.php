<?php

namespace app\home\model;

class Categorya extends BaseModel
{
    protected $hidden = ['description','update_time','delete_time'];
    public function cab(){
        return $this->hasMany('Categoryb','ca_id','caid');
    }

    public static function getCategorya(){
        $categoryas = self::field('caid,caname,cgall')->select();
        return $categoryas;
    }
}
