<?php

namespace app\home\controller;

use app\admin\model\Card;
use app\home\model\Book;
use app\home\model\Company_info;
use app\home\model\Prodis;
use think\Controller;
use think\Request;
use think\Session;
use app\admin\model\Com_pic;
use app\home\model\User_person;
use think\Db;

class ShangpuController extends Controller
{

    //商铺首页
    public function index($id)
    {
        Session::set('c_id',$id);
        $c_id=Session::get('c_id');
        $info = Company_info::where('com_id',$c_id)->find();
        $pics = Com_pic::where("com_id" , $c_id )->find();
        $card = Card::where('com_id',$c_id)->limit(10)->select();
        $card2= Prodis::where('com_id',$c_id)->limit(8)->select();
        $book = Book::where('com_id',$c_id)->select();

        $this->assign(['c_id'=>$id,'info'=>$info,'pics'=>$pics,'card'=>$card,'book'=>$book,'card2'=>$card2]);

        return $this->fetch();
    }
    //公司简介
    public function gongsijianjie()
    {
        $c_id = Session::get('c_id');
        $info = Company_info::where('com_id',$c_id)->find();
        $pics = Com_pic::where("com_id" , $c_id )->find();
        $this->assign([
            'info'=>$info,
            'c_id'=>$c_id,
            'pics'=>$pics
        ]);
        return $this->fetch();
    }
    //产品贴牌
    public function qiyetiepai()
    {
        $c_id=Session::get('c_id');
        $info = Company_info::where('com_id',$c_id)->find();
        $pics = Com_pic::where("com_id" , $c_id )->find();
        $card = Card::where('com_id',$c_id)->select();
        $this->assign(['c_id'=>$c_id,'pics'=>$pics,'info'=>$info,'card'=>$card]);
        return $this->fetch();
    }
    //视频展示
    public function shipinzhanshi()
    {
        $c_id=Session::get('c_id');
        $info = Company_info::where('com_id',$c_id)->find();
        $pics = Com_pic::where("com_id" , $c_id )->find();
        $this->assign(['c_id'=>$c_id,'pics'=>$pics,'info'=>$info]);
        return $this->fetch();
    }
    //产品展厅
    public function chanpinzhanting()
    {
        $c_id=Session::get('c_id');
        $info = Company_info::where('com_id',$c_id)->find();
        $pics = Com_pic::where("com_id" , $c_id )->find();
        $card2= Prodis::where('com_id',$c_id)->select();
        $this->assign(['c_id'=>$c_id,'pics'=>$pics,'info'=>$info,'card2'=>$card2]);
        return $this->fetch();
    }
    //联系我们
    public function lianxiwomen()
    {
        $c_id = Session::get('c_id');
        $info = Company_info::where('com_id',$c_id)->find();
        $pics = Com_pic::where("com_id" , $c_id )->find();
        $this->assign(['info'=>$info,'c_id'=>$c_id,'pics'=>$pics]);
        return $this->fetch();
    }
    //贴牌详情
    public function tpxq($id)
    {
        Session::set('id',$id);
        $c_id=Session::get('id');
        //获取加工产品
        $c_info = Card::where('id',$c_id)->find();
        $tel = Company_info::where('com_id',$c_info['com_id'])->column('tel');

        $this->assign(['info'=>$c_info,
            'tel'=>$tel,

        ]);

        $user_id = Session('user_id');
        $user = User_person::where('user_id',$user_id)->find();
        $this->assign('user',$user);

        return $this->fetch();
    }
}
