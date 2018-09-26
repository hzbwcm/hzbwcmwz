<?php

namespace app\home\model;

use think\Model;
use traits\model\SoftDelete;

class company_info extends Model
{

    use SoftDelete;

    protected $deleteTime = 'delete_time';

    public static function  invoke()
    {
        $id = request()->param('com_id');
        return company_info::get($id);
    }


}
