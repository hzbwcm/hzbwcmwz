<?php

namespace app\home\model;

use think\Model;

class BannerItem extends BaseModel
{
    protected $hidden = ['update_time','delete_time'];

    public static function getBannerItem(){
        $banneritem = self::where('banner_id','=',8)->field('bitemid,bantitle,banessay,bitem_img,banner_id,hm_id')->select();
        return $banneritem;
    }
}