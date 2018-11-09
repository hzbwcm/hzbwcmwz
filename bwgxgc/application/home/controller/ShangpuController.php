<?php

namespace app\home\controller;

use app\admin\model\Card;
use app\home\model\Book;
use app\home\model\Company_info;
use think\Controller;
use think\Request;
use think\Session;
use app\admin\model\Com_pic;
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
        $card2= Card::where('com_id',$c_id)->order('id', 'desc')->limit(8)->select();
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
        $card = Card::where('com_id',$c_id)->limit(10)->select();
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
        $card2= Card::where('com_id',$c_id)->order('id', 'desc')->limit(8)->select();
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

}
