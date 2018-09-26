<?php
namespace app\admin\model;

use think\Model;

class User extends Model
{
    use SoftDelete;

    protected $deleteTime = 'delete_time';

    public static function  invoke()
    {
        $id = request()->param('id');
        return company_info::get($id);
    }
}