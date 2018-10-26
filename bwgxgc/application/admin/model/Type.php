<?php

namespace app\admin\model;

use think\Model;


class Type extends Model
{


    public static function invoke()
    {
        $id = request()->param('type_id');
        return self::get($id);
    }
    public function attribute()
    {
        return $this->hasMany('Attribute','type_id','type_id');
    }
}