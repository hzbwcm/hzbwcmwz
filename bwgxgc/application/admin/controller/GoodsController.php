<?php

namespace app\admin\controller;

use app\admin\model\Company_info;
use app\admin\model\Customgood;
use app\admin\model\Prodis;
use app\admin\model\Type;
use app\admin\model\Card;
use think\Controller;
use think\Request;
use think\Validate;
use app\admin\behavior\CheckLogin;
use think\Session;
use app\admin\model\Com_pic;
use think\Db;

class GoodsController extends Controller
{       //贴牌管理
    public function tpgl()
    {
        $com_id = Session::get('com_id');
        $info = Card::where('com_id', $com_id)->order('id desc')->paginate(10);
        $pagelist = $info->render();
        $this->assign('info',$info);
        $this->assign('pagelist',$pagelist);
        return $this-> fetch();
    }

    //贴牌编辑
    public function tpbj($id)
    {
        $com_id = Session::get('com_id');
        $com = Company_info::where('com_id', $com_id)->find();
        $info = Card::where('id', $id)->find();
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
            $info1 = $pic1 ? $pic1->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif','ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card') : '';
            $info2 = $pic2 ? $pic2->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif','ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card') : '';
            $info3 = $pic3 ? $pic3->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif','ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card') : '';
            $info4 = $pic4 ? $pic4->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif','ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card') : '';
            $info1 = $info1 ? $info1->getSaveName() : '';
            $info2 = $info2 ? $info2->getSaveName() : '';
            $info3 = $info3 ? $info3->getSaveName() : '';
            $info4 = $info4 ? $info4->getSaveName() : '';
            $info4 = $info4 ? 'card' . "/" . $info4 : '';
            $info3 = $info3 ? 'card' . "/" . $info3 : '';
            $info1 = $info1 ? 'card' . "/" . $info1 : '';
            $info2 = $info2 ? 'card' . "/" . $info2 : '';
            $data = ['com_id' => $shuju['com_id'],
                'company_name' => $shuju['company_name'],
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
            $res = $card->allowField(true)->where('id',$id)->update($data);

            if ($res) {
                return $this->success('修改成功');
            } else {
                return $this->error('修改失败,请确保图片大小在500K以下，并为正规图片文件');
            }
        }
        return $this->fetch();
    }
    //贴牌删除
    public function  tpdel(Request $request)
    {
        if ($request->isAjax())
        {
            $id = $request->get('id');
            $res = Card::where('id',$id)->find()->delete();
            if($res)
            {
                return ['code'=> 200, 'data'=> '删除成功'];
            }else{
                return ['code'=> 0, 'msg'=> '删除失败'];
            }
        }
    }

    //贴牌上传
    public function tiepaishangpingshangchuan(Request $request)
    {
        $com_id = Session::get('com_id');
        $com = Company_info::where('com_id', $com_id)->find();
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
            $info5 = request()->param();
//                $info5 = [];
            for ($x = 1; $x < 5; $x++) {
                $file = request()->file('pic' . $x);

                if($file){

                    $info = $file->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif','ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card');
                    if($info==false)
                    {
                        return $this->error('上传失败,请确保图片在大小在500k以下，并为正规图片文件');
                    }
                    $info2 = $info->getSaveName();
                    $info3 = 'card' . "/" . $info2;
                    $info5['pic'.$x]
                        = $info3;

                }else{
                    $info5['pic'.$x]
                        = '';
                }

            }
            $info5['com_id']=$com_id;
            $com_pic = new Card();
            $cs = Com_pic::where('com_id',$com_id)->select();
            $com_pic->save([
                'com_id'  =>  $info5['com_id'],
                'pic1' =>  $info5['pic1'],
                'pic2' =>  $info5['pic2'],
                'pic3' =>  $info5['pic3'],
                'pic4' =>  $info5['pic4'],
                'company_name' =>  $info5['company_name'],
                'type' =>  $info5['type'],
                'carname' =>  $info5['carname'],
                'pro' =>  $info5['pro'],
                'length' =>  $info5['length'],
                'width' => $info5['width'],
                'xinti' => $info5['xinti'],
                'cdgpp' => $info5['cdgpp'],
                'new' => $info5['new'],
                'jsjc' => $info5['jsjc'],
                'vender' =>$info5['vender'],
                'zjnum' => $info5['zjnum'],
                'size' => $info5['size'],
                'sjjc' => $info5['sjjc'],
                'pnum' => $info5['znum'],
                'bzxs' =>$info5['bzxs'],
                'bzgg' => $info5['bzgg'],
                'sbbh' => $info5['sbbh'],
                'qdl' => $info5['qdl'],
                'logo' => $info5['logo'],
                'instruction' => $info5['instruction'],

            ]);




            if ($com_pic) {
                return $this->success('成功了');
            } else {
                return $this->error('失败了，请确保图片大小在500K以下，并为正规图片文件');
            }
        }




        return $this->fetch();
    }

    //定制
    public function dingzspsc(Request $request)
    {
        $com_id = Session::get('com_id');
        //获取一级元素
        $type = new type();
        $type_data1 = $type->where('type_pid', 0)->select();
        $this->assign('type_data1', $type_data1);
        //获取二级元素
        $res = $request->get('typeid');
        $type_data2 = $type->where('type_pid', $res)->select();
        if ($request->isAjax()) {
            if ($type_data2) {
                return ['code' => 200, 'data' => $type_data2];
            } else {
                return ['code' => 0, 'msg' => '获取二级分类失败'];
            }
        }
        $name = Company_info::where('com_id', $com_id)->value('company_name');
        if ($request->isPost()) {
            $shuju = $request->post();

            $cus_pic = request()->file('cus_pic');
            $data  = $cus_pic  ? $cus_pic->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'customgood') : '';
            $cus_pic1 = request()->file('cus_pic1');
            $data1 = $cus_pic1 ? $cus_pic1->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'customgood') : '';
            $cus_pic2 = request()->file('cus_pic2');
            $data2 = $cus_pic2 ? $cus_pic2->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'customgood') : '';
            $cus_pic3 = request()->file('cus_pic3');
            $data3 = $cus_pic3 ? $cus_pic3->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'customgood') : '';
            if($data){
                $data = $data ? $data->getSaveName() : '';
                $data = $data ? 'customgood' . "/" .  $data : '';

            }else if($cus_pic){
                $this->error('主图上传失败' . '：' . $cus_pic->getError(),'goods/dingzspsc');
            }
            if($data1){
                $data1 = $data1 ? $data1->getSaveName() : '';
                $data1 = $data1 ? 'customgood' . "/" .  $data1 : '';
            }else if($cus_pic1){
                $this->error('副图1上传失败' . '：' . $cus_pic1->getError(),'goods/dingzspsc');
            }
            if($data2){
                $data2 = $data2 ? $data2->getSaveName() : '';
                $data2 = $data2 ? 'customgood' . "/" . $data2 : '';
            }else if($cus_pic2){
                $this->error('副图2上传失败' . '：' . $cus_pic2->getError(),'goods/dingzspsc');
            }
            if($data3){
                $data3 = $data3 ? $data3->getSaveName() : '';
                $data3 = $data3 ? 'customgood' . "/" .  $data3 : '';
            }else if($cus_pic3){
                $this->error('副图3上传失败' . '：' . $cus_pic3->getError(),'goods/dingzspsc');
            }

            $rules = [
                'cus_proname' => 'require',
            ];
            $msg = [
                'cus_proname.require' => '必填',

            ];
            $validate = new Validate($rules, $msg);
            if (!$validate->batch()->check($shuju)) {
                $errorinfo = $validate->getError();
                $this->assign('errorinfo', $errorinfo);
                return $this->fetch();
            }

            $shuju['com_id'] = $com_id;
            $shuju['type_id'] = $shuju['typeid'];
            $shuju['issue_name'] = $name;
            $shuju['cus_pic'] = $data;
            $shuju['cus_pic1'] = $data1;
            $shuju['cus_pic2'] = $data2;
            $shuju['cus_pic3'] = $data3;
            $shuju = array_filter($shuju);
            $customgood = new Customgood();
            $result = $customgood->allowField(true)->save($shuju);
            if ($result) {
                $request = Request::instance();
                $ip = $request->ip();
                $acc = Session::get('company_name');
                $data = [
                    'ope_cat' => '企业',
                    'ope_id' => $com_id,
                    'ope_acc' => $acc,
                    'ope_ip' => $ip,
                    'ope_tab' => 'customgood',
                    'ope_act' => '添加',
                ];
                Db::table('ope_log')->insert($data);

                return $this->success('发布成功', 'goods/dingzspsc');
            } else {
                return ['status' => 'failure', 'errorinfo' => '数据写入失败，请联系管理员'];
            }
        }
        return $this->fetch();
    }

    //产品定制管理
    public function cpdzgl()
    {
        $com_id = Session('com_id');
//        $cpdzgl = Customgood::where('com_id', $com_id)->select();
//        $this->assign('cpdzgl', $cpdzgl);

        $page = Customgood::where('com_id',$com_id)->order('cus_id desc')->paginate(10);
        //获得分页的页码列表信息 并传递给模板
        $pagelist = $page->render();

        $this->assign('pagelist',$pagelist);
        $this->assign('info',$page);

        return $this->fetch();
    }

    //产品定制修改
    public function cpdzxg(Request $request)
    {
        $com_id = Session::get('com_id');
        $dataid = $request->param('dataid');

        //获取一级元素
        $type = new type();
        $type_data1 = $type->where('type_pid', 0)->select();
        $this->assign('type_data1', $type_data1);
        //获取二级元素

        if ($request->isAjax()) {
            $res = $request->get('type_id');
            $type_data2 = $type->where('type_pid', $res)->select();
            if ($type_data2) {
                return ['code' => 200, 'data' => $type_data2];
            } else {
                return ['code' => 0, 'msg' => '获取二级分类失败'];
            }
        }
        if ($request->isPost()) {
            $shuju = $request->post();

            $rules = [
                'cus_proname' => 'require',
            ];
            $msg = [
                'cus_proname.require' => '必填',
            ];
            $validate = new Validate($rules, $msg);
            if (!$validate->batch()->check($shuju)) {
                $cus_data = Customgood::where('cus_id', $dataid)->where('com_id', $com_id)->find();
                //获取侧导航默认信息
                $type = new type();
                $type1 = $type->where('type_id', $cus_data['type_id'])->find();

                $type2 = $type->where('type_pid', $cus_data['type_id'])->select();
                $type2_data = $type->where('type_id', $cus_data['type_xj'])->find();


                $this->assign('type1', $type1);
                $this->assign('type2', $type2);
                $this->assign('type2_data', $type2_data);
                $this->assign('cus_data', $cus_data);
                $errorinfo = $validate->getError();
                $this->assign('errorinfo', $errorinfo);
                return $this->fetch();
            }

            $cus_pic = request()->file('cus_pic');
            $data  = $cus_pic  ? $cus_pic->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'customgood') : '';
            $cus_pic1 = request()->file('cus_pic1');
            $data1 = $cus_pic1 ? $cus_pic1->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'customgood') : '';
            $cus_pic2 = request()->file('cus_pic2');
            $data2 = $cus_pic2 ? $cus_pic2->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'customgood') : '';
            $cus_pic3 = request()->file('cus_pic3');
            $data3 = $cus_pic3 ? $cus_pic3->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'customgood') : '';
            if($data){
                $data = $data ? $data->getSaveName() : '';
                $data = $data ? 'customgood' . "/" .  $data : '';

                $pic = Customgood::where('cus_id',$dataid)->value('cus_pic');
                $filename = ROOT_PATH . 'public/uploads' . '/' . $pic;
                if(file_exists($filename)){
                    unlink($filename);
                }

            }else if($cus_pic){
                $this->error('主图上传失败' . '：' . $cus_pic->getError(),'admin/goods/cpdzgl');
            }
            if($data1){
                $data1 = $data1 ? $data1->getSaveName() : '';
                $data1 = $data1 ? 'customgood' . "/" .  $data1 : '';

                $pic1 = Customgood::where('cus_id',$dataid)->value('cus_pic1');
                $filename1 = ROOT_PATH . 'public/uploads' . '/' . $pic1;
                if(file_exists($filename1)){
                    dump($filename1);
                    die;
                    unlink($filename1);
                }

            }else if($cus_pic1){
                $this->error('副图1上传失败' . '：' . $cus_pic1->getError(),'admin/goods/cpdzgl');
            }
            if($data2){
                $data2 = $data2 ? $data2->getSaveName() : '';
                $data2 = $data2 ? 'customgood' . "/" . $data2 : '';

                $pic2 = Customgood::where('cus_id',$dataid)->value('cus_pic2');
                $filename2 = ROOT_PATH . 'public/uploads' . '/' . $pic2;
                if(file_exists($filename2)){
                    unlink($filename2);
                }

            }else if($cus_pic2){
                $this->error('副图2上传失败' . '：' . $cus_pic2->getError(),'admin/goods/cpdzgl');
            }
            if($data3){
                $data3 = $data3 ? $data3->getSaveName() : '';
                $data3 = $data3 ? 'customgood' . "/" .  $data3 : '';

                $pic3 = Customgood::where('cus_id',$dataid)->value('cus_pic3');
                $filename3 = ROOT_PATH . 'public/uploads' . '/' . $pic3;
                if(file_exists($filename3)){
                    unlink($filename3);
                }

            }else if($cus_pic3){
                $this->error('副图3上传失败' . '：' . $cus_pic3->getError(),'admin/goods/cpdzgl');
            }

            $customgood = new customgood();

            $shuju['cus_pic'] = $data;
            $shuju['cus_pic1'] = $data1;
            $shuju['cus_pic2'] = $data2;
            $shuju['cus_pic3'] = $data3;

            $shuju = array_filter($shuju);
            $res = $customgood->where('cus_id', $dataid)->update($shuju);
            if ($res) {
                $request = Request::instance();
                $ip = $request->ip();
                $acc = Session::get('company_name');
                $data = [
                    'ope_cat' => '企业',
                    'ope_id' => $com_id,
                    'ope_acc' => $acc,
                    'ope_ip' => $ip,
                    'ope_tab' => 'customgood',
                    'ope_act' => '修改',
                ];
                Db::table('ope_log')->insert($data);

                $this->success('信息更新成功!', '/admin/goods/cpdzxg/dataid/'.$dataid.'.html');  //TODO 更新成功页面跳转
            } else {
                $this->error('信息更新失败!');
            }
        } else {
            $cus_data = Customgood::where('cus_id', $dataid)->where('com_id', $com_id)->find();
            //获取侧导航默认信息
            $type = new type();
            $type1 = $type->where('type_id', $cus_data['type_id'])->find();

            $type2 = $type->where('type_pid', $cus_data['type_id'])->select();
            $type2_data = $type->where('type_id', $cus_data['type_xj'])->find();

            $this->assign('type1', $type1);
            $this->assign('type2', $type2);
            $this->assign('type2_data', $type2_data);
            $this->assign('cus_data', $cus_data);
            return $this->fetch();
        }

        return $this->fetch();
    }

    //产品定制删除
    public function delcpdz(Request $request)
    {
        $com_id = Session::get('com_id');
        $cusid = $request->get('cusid');
        $res = Customgood::where('cus_id', $cusid)->find()->delete();
        if ($res) {

            $request = Request::instance();
            $ip = $request->ip();
            $acc = Session::get('company_name');
            $data = [
                'ope_cat' => '企业',
                'ope_id' => $com_id,
                'ope_acc' => $acc,
                'ope_ip' => $ip,
                'ope_tab' => 'customgood',
                'ope_act' => '删除',
            ];
            Db::table('ope_log')->insert($data);

            return true;
        } else {
            return false;
        }
    }
    //产品展示管理
    public function progl()
    {
        $com_id = Session::get('com_id');
        $info = Prodis::where('com_id', $com_id)->order('id desc')->paginate(10);
        $this->assign('info',$info);
        $pagelist = $info->render();
        $this->assign('pagelist',$pagelist);
        return $this-> fetch();
    }
    //产品展示商品上传
    public function cpzsspsc(Request $request)
    {
        $com_id = Session::get('com_id');
        $com = Company_info::where('com_id', $com_id)->find();
        $this->assign([
            'com_id'=>$com_id,
            'com'=>$com
        ]);
        if (request()->isPost()) {

            $shuju = request()->param();
            $pic1 = request()->file('pic1');
            $pic2 = request()->file('pic2');
            $pic3 = request()->file('pic3');
            $pic4 = request()->file('pic4');
            $info1 = $pic1 ? $pic1->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'prodis') : '';

            $info2 = $pic2 ? $pic2->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'prodis') : '';

            $info3 = $pic3 ? $pic3->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'prodis') : '';

            $info4 = $pic4 ? $pic4->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'prodis') : '';

            $info1 = $info1 ? $info1->getSaveName() : '';
            $info2 = $info2 ? $info2->getSaveName() : '';
            $info3 = $info3 ? $info3->getSaveName() : '';
            $info4 = $info4 ? $info4->getSaveName() : '';
            $info4 = $info4 ? 'prodis' . "/" . $info4 : '';
            $info3 = $info3 ? 'prodis' . "/" . $info3 : '';
            $info1 = $info1 ? 'prodis' . "/" . $info1 : '';
            $info2 = $info2 ? 'prodis' . "/" . $info2 : '';


            $data = ['com_id' => $shuju['com_id'],
                'company_name' => $shuju['company_name'],
                'proname'=>$shuju['proname'],
                'qdl'=>$shuju['qdl'],
                'price'=>$shuju['price'],
                'pic1' => $info1,
                'pic2' => $info2,
                'pic3' => $info3,
                'pic4' => $info4

            ];

            $data = array_filter($data);
            $card = new Prodis();
            $res = $card->allowField(true)->save($data);
            if ($res) {
                return $this->success('上传成功');
            } else {
                return $this->error('上传失败,请确保图片大小在500K以下，并为正规图片文件');
            }

        }

        return $this->fetch();
    }
    //产品展示修改
    public function progai($id)
    {
        //$com_id = Session::get('com_id');
        $info = Prodis::where('id', $id)->find();
        $this->assign('info',$info);
        if (request()->isPost()) {

            $shuju = request()->param();
            $pic1 = request()->file('pic1');
            $pic2 = request()->file('pic2');
            $pic3 = request()->file('pic3');
            $pic4 = request()->file('pic4');
            $info1 = $pic1 ? $pic1->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif','ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card') : '';
            $info2 = $pic2 ? $pic2->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif','ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card') : '';
            $info3 = $pic3 ? $pic3->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif','ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card') : '';
            $info4 = $pic4 ? $pic4->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif','ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'card') : '';
            $info1 = $info1 ? $info1->getSaveName() : '';
            $info2 = $info2 ? $info2->getSaveName() : '';
            $info3 = $info3 ? $info3->getSaveName() : '';
            $info4 = $info4 ? $info4->getSaveName() : '';
            $info4 = $info4 ? 'card' . "/" . $info4 : '';
            $info3 = $info3 ? 'card' . "/" . $info3 : '';
            $info1 = $info1 ? 'card' . "/" . $info1 : '';
            $info2 = $info2 ? 'card' . "/" . $info2 : '';
            $data = [
                'com_id' => $shuju['com_id'],
                'company_name' => $shuju['company_name'],
                'proname' => $shuju['proname'],
                'qdl'=> $shuju['qdl'],
                'pic1' => $info1,
                'pic2' => $info2,
                'pic3' => $info3,
                'pic4' => $info4
            ];
            $data = array_filter($data);

            $prodis = new Prodis();
            $res = $prodis->allowField(true)->where('id',$id)->update($data);

            if ($res) {
                return $this->success('修改成功');
            } else {
                return $this->error('修改失败,请确保图片大小在500K以下，并为正规图片文件');
            }
        }
        return $this->fetch();
    }
    //产品展示删除
    public function  prodel(Request $request)
    {
        if ($request->isAjax())
        {
            $id = $request->get('id');
            $res = Prodis::where('id',$id)->find()->delete();
            if($res)
            {
                return ['code'=> 200, 'data'=> '删除成功'];
            }else{
                return ['code'=> 0, 'msg'=> '删除失败'];
            }
        }
    }
}