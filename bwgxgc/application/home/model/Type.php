<?php

namespace app\home\model;

use think\Model;

class Type extends Model
{
    public static function invoke()
    {
        $id = request()->param('type_id');
        return self::get($id);
    }
}
