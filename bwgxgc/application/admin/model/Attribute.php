<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Attribute extends Model
{
    //要去使用SoftDelete中的成员
    use SoftDelete;
    //设置软删除对应的数据表“删除字段”
    protected $deleteTime = 'delete_time';
    /*
     * 根据pathinfo传递的参数，把依赖注入的对象是获得出来
     */
    public static function invoke()
    {
        $id = request()->param('attr_id');
        return self::get($id);//返回的model对象可以被控制器方法的接收
    }
}
