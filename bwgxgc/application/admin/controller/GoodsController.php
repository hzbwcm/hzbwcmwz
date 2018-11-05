<?php
namespace app\admin\controller;

use app\admin\model\Card;
use think\Controller;
use think\Request;
use app\admin\behavior\CheckLogin;
use think\Session;

class GoodsController extends Controller
{
    public function tiepaishangpingshangchuan(Request $request)
    {
        $com_id = Session::get('com_id');
        $info =Card::where('com_id', $com_id)->find();
        $type = ['卫生巾','婴儿纸尿裤','成人纸尿裤','湿纸巾','生活用纸','产妇巾','经期裤','护理垫','宠物垫','乳垫'];
        $new = ['5','6','7','8','9'];
        $zjnum = ['1-5','6-10','11-15','16-20','20以上'];
        $znum = ['1-50','51-100','101-150','151-200','200以上'];
        $bzxs = ['全自动包装','半自动包装','手工包装'];
        $this->assign([
            'type' => $type,
            'new' =>$new,
            'zjnum'=>$zjnum,
            'znum'=>$znum,
            'bzxs'=>$bzxs,
            'com_id'=>$com_id,
            'info'=>$info
        ]);
        if (request()->isPost()){

            $shuju = request()->param();
            dump($shuju);
            die;
        }
        return $this->fetch();
    }



}