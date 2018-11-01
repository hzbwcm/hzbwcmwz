<?php
use think\Route;

//home分组
Route::get('/','home/index/index');//首页
Route::get('home/index/index','home/index/index');//首页
Route::get('home/index/foot_base','home/index/foot_base');//页脚
Route::get('home/user/sms','home/user/sms');//短信个人测试
Route::post('home/user/sendsms','home/user/sendsms');//发送短信
Route::get('home/user/register','home/user/register');//注册1

Route::any('home/user/gerenzhuce','home/user/gerenzhuce',['method'=>'get|post']);//个人注册
Route::get('home/user/zhuceshibai','home/user/zhuceshibai');//个人注册失败
Route::any('home/user/qiyezhuce','home/user/qiyezhuce',['method'=>'get|post']);//企业注册
Route::any('home/user/login','home/user/login',['method'=>'get|post']);//登录

Route::group('home',function (){
    Route::any('user/loginout','home/user/loginout',['method'=>'get|post']);//退出登录
    Route::get('user/accountcenter','home/user/accountcenter');//个人中心
    Route::any('user/usercenter','home/user/usercenter',['method'=>'get|post']);//个人信息
    Route::any('user/fabuxinxi','home/user/fabuxinxi',['method'=>'get|post']);//发布信息
    Route::any('user/pic_up','home/user/pic_up',['method'=>'get|post']);//图片上传
    Route::get('user/xinxiguanlishouye','home/user/xinxiguanlishouye');//信息管理首页
    Route::get('user/xinxiguanli','home/user/xinxiguanli');//信息管理
    Route::get('index/shoucangjia','home/index/shoucangjia');//收藏夹
},['after_behavior'=>'\app\home\behavior\CheckLogin']);


//admin分组
Route::get('home/custom/custom','home/custom/custom');//产品定制
Route::get('home/custom/get_area','home/custom/get_area');//产品定制
Route::get('home/stickacard/stickacard','home/stickacard/stickacard');//贴牌专区
Route::get('home/stickacard/tiepaixiangqing','home/stickacard/tiepaixiangqing');//贴牌详情
Route::get('home/stickacard/tiepaigengduo','home/stickacard/tiepaigengduo');//贴牌更多
Route::get('admin/goods/tiepaishangpingshangchuan','admin/goods/tiepaishangpingshangchuan');//贴牌更多
Route::get('home/inspection/inspection','home/inspection/inspection');//优选验厂
Route::get('home/documentary/documentary','home/documentary/documentary');//跟单专家
Route::get('home/index/wlpf','home/index/wlpf');//网络批发
Route::get('home/shebeitransfer/shebeitransfer','home/shebeitransfer/shebeitransfer');//设备转让
Route::get('home/shebeitransfer/shebeizhuanrang','home/shebeitransfer/shebeizhuanrang');//设备转让详情
Route::get('home/custom/customizing','home/custom/customizing');//产品定制详情详情页
Route::get('home/index/shoucangjia','home/index/shoucangjia');//收藏夹

//企业商铺
Route::get('home/shangpu/index','home/shangpu/index');//优选验厂商铺首页
Route::get('home/shangpu/gongsijianjie','home/shangpu/gongsijianjie');//优选验厂商铺公司简介
Route::get('home/shangpu/chanpintiepai','home/shangpu/qiyetiepai');//优选验厂贴牌专区
Route::get('home/shangpu/shipinzhanshi','home/shangpu/shipinzhanshi');//优选验厂视频展示
Route::get('home/shangpu/chanpinzhanting','home/shangpu/chanpinzhanting');//优选验厂产品展厅
Route::get('home/shangpu/lianxiwomen','home/shangpu/lianxiwomen');//优选验厂联系我们


//admin 分组
Route::any('admin/user/login','admin/user/login');//admin登陆
Route::get('admin/type/index','admin/type/index');//商品类型
Route::any('admin/type/addition','admin/type/addition',['method'=>'get|post']);//商品类型添加
Route::get('admin/attribute/index','admin/attribute/index');//商品属性
Route::any('admin/attribute/addition','admin/attribute/addition',['method'=>'get|post']);//商品属性添加
Route::get('admin/attribute/getAttributeByType','admin/attribute/getAttributeByType');//商品属性添加
Route::get('admin/user/guanliyuan','admin/user/guanliyuan');//管理员表
Route::get('admin/role/index','admin/role/index');//角色表
Route::any('admin/role/gai','admin/role/gai',['method'=>'get|post']);//角色修改
Route::get('admin/permission/index','admin/permission/index');//权限表
Route::any('admin/permission/addition','admin/permission/addition',['method'=>'get|post']);//权限添加
Route::get('admin/user/gerenxinxi','admin/user/gerenxinxi');//个人信息
Route::group('admin',function (){
    Route::get('user/logout','admin/user/logout');//admin退出
    Route::get('index/index','admin/index/index');//admin首页
    Route::get('index/welcome','admin/index/welcome');//admin首页welcome

    //Route::post('user/login','admin/user/login');//admin登陆
},['after_behavior'=>'\app\admin\behavior\CheckLogin']);



