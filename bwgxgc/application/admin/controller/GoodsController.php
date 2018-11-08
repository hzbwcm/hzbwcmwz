<?php

namespace app\admin\controller;

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
            $info1 = $pic1->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card');

            $info2 = $pic2->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card');

            $info3 = $pic3->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card');

            $info4 = $pic4->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card');

            $info1 = $info1->getSaveName();
            $info2 = $info2->getSaveName();
            $info3 = $info3->getSaveName();
            $info4 = $info4->getSaveName();
            $info4 = 'com_pic' . "/" . $info4;
            $info3 = 'com_pic' . "/" . $info3;
            $info1 = 'com_pic' . "/" . $info1;
            $info2 = 'com_pic' . "/" . $info2;
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
            Db::name('card')->insert($data);

        }
        return $this->fetch();
    }

    public function dingzspsc()
    {
        return $this->fetch();
    }


}