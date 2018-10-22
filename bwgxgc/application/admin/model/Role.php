<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Role extends Model
{
    use SoftDelete;

    protected $deleteTime = 'delete_time';
    public static function invoke()
    {
        $id = request()->param('role_id');
        return self::get($id);
    }
}
