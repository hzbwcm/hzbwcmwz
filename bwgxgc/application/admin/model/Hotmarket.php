<?php

namespace app\admin\model;

class Hotmarket extends BaseModel
{
    public function getCreateTimeAttr($time)
    {
        return $time;//返回create_time原始数据，不进行时间戳转换。
    }

    public function caname(){
        return $this->belongsTo('Categorya','cb_id');
    }

    public static function getHotMarkets(){
        $hotmarkets = self::field('hmid,ca_id,cb_id,ca_name,cb_name,hmauthor,hmtitle,hmtext,lethots,hotissue,create_time')->select();
        return $hotmarkets;
    }
    public static function getHotSpots(){
        $hotspots = self::where('lethots','=','hzbwallow')->field('hmid,hmauthor,hmtitle,hsessay,hsimg,hotissue,lethots')->select();
        return $hotspots;
    }
}
