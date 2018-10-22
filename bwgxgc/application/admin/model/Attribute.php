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
        //return $this->hasOne(关联模型,关联模型联系字段,本模型联系的字段);
        return $this->hasOne('Type','type_id','type_id');
    }
}
