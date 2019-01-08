<?php

namespace app\home\model;

use think\Model;
use traits\model\SoftDelete;

class Company_info extends Model
{

    use SoftDelete;

    protected $deleteTime = 'delete_time';

    public static function  invoke()
    {
        $id = request()->param('com_id');
        return Company_info::get($id);
    }


}
