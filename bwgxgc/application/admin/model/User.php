<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class User extends Model
{
    use SoftDelete;

    protected $deleteTime = 'delete_time';

    public static function  invoke()
    {
        $id = request()->param('com_id');
        return company_info::get($id);
    }
}