<?php

namespace app\admin\controller;

use app\admin\model\Company_info;
use app\admin\model\Customgood;
use app\admin\model\Type;
use app\admin\model\Card;
use think\Controller;
use think\Request;
use think\Validate;
use app\admin\behavior\CheckLogin;
use think\Session;
use think\Db;

class GoodsController extends Controller
{
    public function tpgl()
    {
        $com_id = Session::get('com_id');
        $info = Card::where('com_id', $com_id)->select();
        $this->assign('info',$info);
        return $this-> fetch();
    }
    public function tpglxg()
    {
        $com_id = Session::get('com_id');
        $info = Card::where('com_id', $com_id)->select();
        $this->assign('info',$info);
        return $this-> fetch();
    }

    public function tiepaishangpingshangchuan(Request $request)
    {
        $com_id = Session::get('com_id');
        $com = Company_info::where('com_id',$com_id)->find();
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
            'info' => $info,
            'com' => $com
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
                'company_name'=>$shuju['company_name'],
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
            $card = new Card();
            $res=$card ->allowField(true)->save($data);
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
        //获取一级元素
        $type = new type();
        $type_data1 = $type->where('type_pid',0)->select();
        $this->assign('type_data1',$type_data1);
        //获取二级元素
        $res = $request->get('typeid');
        $type_data2 = $type->where('type_pid',$res)->select();
        if($request->isAjax()){
            if ($type_data2) {
                return ['code' => 200, 'data' => $type_data2];
            }else{
                return ['code' => 0, 'msg' => '获取二级分类失败'];
            }
        }
        $name = Company_info::where('com_id',$com_id)->value('company_name');
        if($request->isPost()){
            $shuju = $request->post();
            $rules = [
                'cus_proname'          =>'require',
                'cus_length'           =>'require',
                'cus_width'            =>'require',
                'cus_place'            =>'require',
                'cus_supply'           =>'require',
                'cus_orders'           =>'require',
            ];
            $msg = [
                'cus_proname.require'      => '必填',
                'cus_length.require'       => '必填',
                'cus_width.require'        => '必填',
                'cus_place.require'        => '必填',
                'cus_supply.require'       => '必填',
                'cus_orders.require'       => '必填',

            ];
            $validate = new Validate($rules,$msg);
            if(!$validate->batch()->check($shuju)){
                $errorinfo=$validate->getError();
                $this -> assign('errorinfo',$errorinfo);
                return $this -> fetch();
            }

            $customgood = new Customgood();
            $shuju['com_id'] = $com_id;
            $shuju['type_id'] = $shuju['typeid'];
            $shuju['issue_name'] = $name;
            $result = $customgood->allowField(true)->save($shuju);
            if($result){
                $request = Request::instance();
                $ip = $request->ip();
                $acc = Session::get('company_name');
                $data = [
                    'ope_cat' => '企业',
                    'ope_id' => $com_id,
                    'ope_acc'=> $acc,
                    'ope_ip'=> $ip,
                    'ope_tab'=> 'customgood',
                    'ope_act' => '添加',
                ];
                Db::table('ope_log')->insert($data);

                return $this->success('发布成功','goods/dingzspsc');
            }else{
                return ['status'=>'failure','errorinfo'=>'数据写入失败，请联系管理员'];
            }
        }
        return $this->fetch();
    }
    //产品定制管理
    public function cpdzgl()
    {
        $com_id = Session('com_id');
        $cpdzgl = Customgood::where('com_id',$com_id)->select();
        $this->assign('cpdzgl',$cpdzgl);

        $type = new type();
        $type = $type->select();
        $this->assign('type',$type);
        return $this->fetch();
    }

    //产品定制修改
    public function cpdzxg(Request $request){
        $com_id = Session::get('com_id');

        $dataid = $request->param('dataid');

        $customgood = new customgood();

        //获取一级元素
        $type = new type();
        $type_data1 = $type->where('type_pid',0)->select();
        $this->assign('type_data1',$type_data1);
        //获取二级元素

        if($request->isAjax()){
            $res = $request->get('type_id');
            $type_data2 = $type->where('type_pid',$res)->select();
            if ($type_data2) {
                return ['code' => 200, 'data' => $type_data2];
            }else{
                return ['code' => 0, 'msg' => '获取二级分类失败'];
            }
        }
        if($request->isPost()){
            $shuju = $request->post();
            $rules = [
                'cus_proname'          =>'require',
                'cus_length'           =>'require',
                'cus_width'            =>'require',
                'cus_place'            =>'require',
                'cus_supply'           =>'require',
                'cus_orders'           =>'require',
            ];
            $msg = [
                'cus_proname.require'      => '必填',
                'cus_length.require'       => '必填',
                'cus_width.require'        => '必填',
                'cus_place.require'        => '必填',
                'cus_supply.require'       => '必填',
                'cus_orders.require'       => '必填',

            ];
            $validate = new Validate($rules,$msg);
            if(!$validate->batch()->check($shuju)){
                $errorinfo=$validate->getError();
                $this -> assign('errorinfo',$errorinfo);
                return $this -> fetch();
            }
            $customgood = new customgood();
            $res = $customgood->where('cus_id', $dataid)->update($shuju);
            if ($res) {
                $this->success('信息更新成功!','admin/goods/cpdzgl');  //TODO 更新成功页面跳转
            }else{
                $this->error('信息更新失败!');
            }
        }else{
            $cus_data = Customgood::where('cus_id', $dataid)->where('com_id',$com_id)->find();
            //获取侧导航默认信息
            $type = new type();
            $type1 = $type->where('type_id',$cus_data['type_id'])->find();

            $type2 = $type->where('type_pid',$cus_data['type_id'])->select();
            $type2_data=$type->where('type_id',$cus_data['type_xj'])->find();



            $this->assign('type1',$type1);
            $this->assign('type2',$type2);
            $this->assign('type2_data',$type2_data);
            $this->assign('cus_data', $cus_data);
            return $this->fetch();
        }

        return $this->fetch();
    }

    //产品定制删除
    public function delcpdz(Request $request){
        $com_id = Session::get('com_id');
        $cusid = $request ->get('cusid');
        $res = Customgood::where('cus_id',$cusid)->find()->delete();
        if ($res) {

            $request = Request::instance();
            $ip = $request->ip();
            $acc = Session::get('company_name');
            $data = [
                'ope_cat' => '企业',
                'ope_id' => $com_id,
                'ope_acc'=> $acc,
                'ope_ip'=> $ip,
                'ope_tab'=> 'customgood',
                'ope_act' => '删除',
            ];
            Db::table('ope_log')->insert($data);

            return true;
        } else {
            return false;
        }
    }


    //产品展示商品上传
    public function cpzsspsc()
    {
        return $this->fetch();
    }
}