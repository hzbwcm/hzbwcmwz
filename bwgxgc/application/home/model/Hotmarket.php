<?php

namespace app\home\model;

class Hotmarket extends BaseModel
{
    //全部咨询二级展示
    public static function getHotMarket(){
        $hotmarket = self::order('hmid desc')->paginate(20);
        return $hotmarket;
    }
    //热点行情二级展示
    public static function getHotSpot(){
        $hotspot = self::where('hotissue','=','hzbwby')->limit(8)->order('hmid desc')->select();
        return $hotspot;
    }
    //获取bannerid跳转价格行情三级
    public static function getBannerID($pqid){
        $banhm = self::where('hmid','=',$pqid)->find($pqid);
        return $banhm;
    }
    //获取全部咨询id跳转价格行情三级
    public static function getNewsID($pqid){
        $news = self::where('hmid','=',$pqid)->find($pqid);
        return $news;
    }
    //获取热点行情id跳转价格行情三级
    public static function getHotSpotID($pqid){
        $banhs = self::where('hmid','=',$pqid)->find($pqid);
        return $banhs;
    }
}
