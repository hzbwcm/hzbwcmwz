<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Type extends Model
{
    use SoftDelete;

    protected $deleteTime = 'delete_time';

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