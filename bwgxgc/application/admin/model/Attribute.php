<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Attribute extends Model
{
    use SoftDelete;

    protected $deleteTime = 'delete_time';

    public static function invoke()
    {
        $id = request()->param('attr_id');
        return self::get($id);
    }
    public function type()
    {
        return $this->hasOne('Type','type_id','type_id');
    }
}
