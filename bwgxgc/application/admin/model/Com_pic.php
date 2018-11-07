<?php

namespace app\admin\model;

use think\Model;

class Com_pic extends Model
{
    public static function  invoke()
    {

        $id = request()->param('com_id');
        return Company_info::get($id);
    }
}
