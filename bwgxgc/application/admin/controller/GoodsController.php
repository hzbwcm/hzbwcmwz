<?php
namespace app\admin\controller;

use app\admin\model\Company_info;
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
            $file = request()->file('image1');

            $info = $file->rule('uniqid')->move( ROOT_PATH . 'public' . DS . 'uploads'. DS .'card');
            echo $info->getSaveName();
            die();
            dump($info);
            die();
        }
        return $this->fetch();
    }

    public function dingzspsc(Request $request)
    {
        $com_id = Session::get('com_id');

        if($request->isPost()){
            $shuju = Request::instance()->post();

//            $rules = [
//                'cus_proname'          =>'require',
//                'cus_length'           =>'require',
//                'cus_width'            =>'require',
//                'cus_place'            =>'require',
//                'cus_supply'           =>'require',
//                'cus_orders'           =>'require',
//            ];
//            $msg = [
//                'cus_proname.require'      => '必填',
//                'cus_length0.require'       => '必填',
//                'cus_width.require'        => '必填',
//                'cus_place.require'        => '必填',
//                'cus_supply.require'       => '必填',
//                'cus_orders.require'       => '必填',
//
//            ];
//            $validate = new Validate($rules,$msg);
//            if(!$validate->batch()->check($shuju)){
//                $errorinfo=$validate->getError();
//                $this -> assign('errorinfo',$errorinfo);
//                return $this -> fetch();
//            }


            $customgood = new customgood();
            $shuju['com_id'] = $com_id;
            $result = $customgood->allowField(true)->save($shuju);
            if($result){
//                return ['status'=>'success'];
                return $this->success('发布成功','user/fabuxinxi');
            }else{
                return ['status'=>'failure','errorinfo'=>'数据写入失败，请联系管理员'];
            }
        }
        return $this->fetch();

        return $this->fetch();
    }



}