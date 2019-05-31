<?php

namespace app\home\model;

use think\Model;

class Banner extends BaseModel
{
    protected $hidden = ['update_time','delete_time'];
    public function items()
    {
        return $this->hasMany('BannerItem','banner_id','banid');
    }

    public static function getBanner(){
        $banner = self::where('banid','=',8)->find();
        return json($banner);
    }
}
