<?php

namespace app\admin\controller;

use app\admin\model\Company_info;
use app\admin\model\Card;
use think\Controller;
use think\Request;
use app\admin\behavior\CheckLogin;
use think\Session;
use think\Db;

class GoodsController extends Controller
{
    public function tiepaishangpingshangchuan(Request $request)
    {
        $com_id = Session::get('com_id');
        $info = Card::where('com_id', $com_id)->find();
        $type = ['卫生巾', '婴儿纸尿裤', '成人纸尿裤', '湿纸巾', '生活用纸', '产妇巾', '经期裤', '护理垫', '宠物垫', '乳垫'];
        $new = ['5', '6', '7', '8', '9'];
        $zjnum = ['1-5', '6-10', '11-15', '16-20', '20以上'];
        $znum = ['1-50', '51-100', '101-150', '151-200', '200以上'];
        $bzxs = ['全自动包装', '半自动包装', '手工包装'];
        $this->assign([
            'type' => $type,
            'new' => $new,
            'zjnum' => $zjnum,
            'znum' => $znum,
            'bzxs' => $bzxs,
            'com_id' => $com_id,
            'info' => $info
        ]);
        if (request()->isPost()) {

            $shuju = request()->param();
            $pic1 = request()->file('pic1');
            $pic2 = request()->file('pic2');
            $pic3 = request()->file('pic3');
            $pic4 = request()->file('pic4');
            $info1 = $pic1?$pic1->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card'):'';

            $info2 = $pic2?$pic2->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card'):'';

            $info3 =$pic3?$pic3->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card'):'';

            $info4 =$pic4?$pic4->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card'):'';

            $info1 = $info1?$info1->getSaveName():'';
            $info2 = $info2?$info2->getSaveName():'';
            $info3 = $info3?$info3->getSaveName():'';
            $info4 = $info4?$info4->getSaveName():'';
            $info4 = $info4?'card' . "/" . $info4:'';
            $info3 = $info3?'card' . "/" . $info3:'';
            $info1 = $info1?'card' . "/" . $info1:'';
            $info2 = $info2?'card' . "/" . $info2:'';
            $data = ['com_id' => $shuju['com_id'],
                'type' => $shuju['type'],
                'carname' => $shuju['carname'],
                'pro' => $shuju['pro'],
                'length' => $shuju['length'],
                'width' => $shuju['width'],
                'xinti' => $shuju['xinti'],
                'cdgpp' => $shuju['cdgpp'],
                'new' => $shuju['new'],
                'jsjc' => $shuju['jsjc'],
                'vender' => $shuju['vender'],
                'zjnum' => $shuju['zjnum'],
                'size' => $shuju['size'],
                'sjjc' => $shuju['sjjc'],
                'pnum' => $shuju['znum'],
                'bzxs' => $shuju['bzxs'],
                'bzgg' => $shuju['bzgg'],
                'sbbh' => $shuju['sbbh'],
                'qdl' => $shuju['qdl'],
                'logo' => $shuju['logo'],
                'instruction' => $shuju['instruction'],
                'pic1' => $info1,
                'pic2' => $info2,
                'pic3' => $info3,
                'pic4' => $info4

            ];
            $data = array_filter($data);



            $res=Db::name('card')->insert($data);
            if($res)
            {
                return $this->success('上传成功');
            }else
                {
                return $this->error('上传失败');
            }

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