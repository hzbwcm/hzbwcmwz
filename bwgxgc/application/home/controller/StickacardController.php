<?php

namespace app\home\controller;

use app\home\model\Card;
use app\home\model\Company_info;
use app\home\model\User_person;
use app\home\model\Type;
use think\Controller;
use think\Request;
use think\Session;


use app\home\model\Area;

class StickacardController extends Controller
{
    public function tpcollect(Request $request)
    {
        $user_id = Session('user_id');
        $user = User_person::where('user_id',$user_id)->find();
        $this->assign('user',$user);

        $id = $request->param('id');

        if($request->isAjax()){
            if(empty($user['card_fav'])){
                //存储第一个收藏
                $shuju['card_fav'] = $id;
                $result = User_person::where('user_id',$user_id)->update($shuju);
                if($result){
                    return ['fhz'=>200,'info'=>'收藏成功','cusid'=>$id,'fhxx'=>1];
                }else{
                    return ['fhz'=>'failure','errorinfo'=>'收藏失败'];
                }
                //已有收藏，判断当前产品是否存在数据库
            }elseif(in_array($id,explode(',',$user['card_fav']))){
                //判断传值2是否为空，为空则不运行，不为空，则删除
                if(!empty($id)){
                    $data = explode(',',$user['card_fav']);
                    foreach ($data as $k=>$v){
                        if($id == $v) unset($data[$k]);
                    }
                    $data = implode(',',$data);
                    $shuju['card_fav'] = $data;
                    $result = User_person::where('user_id',$user_id)->update($shuju);
                    if($result){
                        return ['fhz'=>200,'info'=>'取消收藏成功','cusid'=>$id,'fhxx'=>2];
                    }else{
                        return ['fhz'=>'failure','errorinfo'=>'取消收藏失败'];
                    }

                }

                //已有产品收藏，但当前页没有收藏过，
            }else{
                $card_fav = User_person::value("concat(card_fav,',',$id)");

                $shuju['card_fav'] = $card_fav;
                $result = User_person::where('user_id',$user_id)->update($shuju);
                if($result){
                    return ['fhz'=>200,'info'=>'收藏成功','cusid'=>$id,'fhxx'=>1];
                }else{
                    return ['fhz'=>'failure','errorinfo'=>'收藏失败'];
                }
            }

        }
    }



    public function stickacard()
    {
        $user_id = Session('user_id');
        $user = User_person::where('user_id',$user_id)->find();
        $this->assign('user',$user);

        $type = Type::where('type_pid',0)->select();
        $info = Card::where('id','>',0)->select();
        $info_obj=[];
        if($user['login_id']==1){
            $card_fav = User_person::where('user_id',$user_id)->value('card_fav');
            $this->assign('scbz',$card_fav);
        }
        for ($i=0;$i < sizeof($type);$i++){
            $info_arr=[];
            for ($j=0;$j < sizeof($info);$j++){
                if($type[$i]['type_name']==$info[$j]['type']){
                    array_push($info_arr,$info[$j]);
                }
            }
            $info_obj[$type[$i]['type_name']] = $info_arr;
        }
        $this->assign([
            'type'=>$type,
            'info'=>$info_obj,
            'user'=>$user['login_id']
        ]);



        return $this->fetch();
    }

    //贴牌详情
    public function tiepaixiangqing($id)
    {
        Session::set('id',$id);
        $c_id=Session::get('id');
        //获取加工产品
        $c_info = Card::where('id',$c_id)->find();
        $tel = Company_info::where('com_id',$c_info['com_id'])->column('tel');

        $this->assign(['info'=>$c_info,
                        'tel'=>$tel
            ]);

        $user_id = Session('user_id');
        $user = User_person::where('user_id',$user_id)->find();
        $this->assign('user',$user);

        return $this->fetch();
    }

    //贴牌更多
    public function tiepaigengduo($ypeame,$yped)
    {
        $tname =$ypeame;
        $tid = $yped;
        $info = Type::where('type_pid',0)->select();
        $tinfo = Type::where('type_pid',$tid)->select();
        $cinfo = Card::where('type',$tname)->order('id desc')->paginate(15,false,['query'=>['ypeame'=>$tname,'yped'=>$tid]]);
        $pagelist = $cinfo->render();
        $this->assign('pagelist',$pagelist);
        $type = Type::select();

        $this->assign([
            'info' => $info,
            'cinfo'  => $cinfo,
            'type' => $type,
            'tinfo'=>$tinfo,
            'tname'=>$tname
        ]);

        return $this->fetch();
    }
}
