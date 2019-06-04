<?php

namespace app\admin\controller;

use app\admin\model\Categorya;
use app\admin\model\Categoryb;
use app\admin\model\Hotmarket;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\Validate;

class HotmarketController extends Controller
{
    //资讯一级分类列表
    public function marketclassificationa()
    {
        $categoryas = Categorya::getCategorya();
        $this->assign([
            'categorya' => $categoryas
        ]);
        return $this->fetch();
    }

    //资讯二级分类列表
    public function marketclassificationb()
    {
        $categorybs = Categoryb::getCategoryb();
        $this->assign([
            'categoryb' => $categorybs
        ]);
        return $this->fetch();
    }

    //价格资讯列表
    public function pricelist()
    {
        $id = Request::instance()->param('id');
        $let = Request::instance()->param('let');
        if(!empty($let)){
            if($let=='bwno1'){
                Db::table('hotmarket')->where('hmid','=',$id)->setField('lethots','hzbwrefuse');
            }
            if($let=='bwno2'){
                Db::table('hotmarket')->where('hmid','=',$id)->setField('lethots','hzbwallow');
            }
        }
        $hotmarkets = Hotmarket::getHotMarkets();
        $this->assign([
            'hotmarkets' => $hotmarkets,
        ]);
        return $this->fetch();
    }
    //热点资讯列表
    public function hotlist()
    {
        $id = Request::instance()->param('id');
        $let = Request::instance()->param('let');
        if(!empty($let)){
            if($let=='review'){
                Db::table('hotmarket')->where('hmid','=',$id)->setField('hotissue','hzbwfail');
            }
            if($let=='unreview'){
                Db::table('hotmarket')->where('hmid','=',$id)->setField('hotissue','hzbwby');
            }
            if($let=='bwno'){
                $test = Hotmarket::where('hmid','=',$id)->value('hotissue');
                if($test=='hzbwby'){
                    Db::table('hotmarket')->where('hmid','=',$id)->setField('hotissue','hzbwfail');
                }
                Db::table('hotmarket')->where('hmid','=',$id)->setField('lethots','hzbwrefuse');
            }
        }
        $hotspots = Hotmarket::getHotSpots();
        $this->assign([
            'hotspots' => $hotspots
        ]);
        return $this->fetch();
    }
    //资讯一级分类添加
    public function addmarketone(Request $request)
    {
        if($request->isPost()){
            $cas = $request->param();
            $rules = [
                'caname' => 'require|unique:categorya,caname'
            ];
            $msg = [
                'caname.require' => '一级分类名称必填',
                'caname.unique' => '一级分类名称不能重复',
            ];
            $validate = new Validate($rules,$msg);
            if($validate->batch()->check($cas)){
                $categorya = new Categorya();
                $result = $categorya->allowField(true)->save($cas);
                if($result){
                    $caid = $categorya->where('caname','=',$cas['caname'])->value('caid');
                    $data = ['ca_id'=>$caid,'cbname'=>'全部','cgall'=>'-1'];
                    Db::name('categoryb')->insert($data);
                    $this->success('添加成功!');
                }else{
                    $this->error('添加失败');
                }
            }else{
                $errorinfo=$validate->getError();
                $this -> assign('errorinfo',$errorinfo);
            }
        }
        return $this->fetch();
    }
    //资讯一级分类修改
    public function altermarketone(Request $request){
        $caid = $request->param('id');
        if($request->isPost()){
            $cas = $request->param();

            $rules = [
                'caname' => 'require|unique:categorya,caname'
            ];
            $msg = [
                'caname.require' => '一级分类名称必填',
                'caname.unique' => '一级分类名称不能重复',
            ];
            $validate = new Validate($rules,$msg);
            if(!$validate->batch()->check($cas)){
                $cas_data = Categorya::where('caid','=',$caid)->find();
                $this->assign('cas_data',$cas_data);
                $errorinfo=$validate->getError();
                $this -> assign('errorinfo',$errorinfo);
                return $this->fetch();
            }
            $data['caname'] = $cas['caname'];
            $categorya = new Categorya();
            $result = $categorya->where('caid','=',$caid)->update($data);
            if($result){
                $this->success('更新成功!');
            }else{
                $this->error('更新失败');
            }
        }else{
            $cas_data = Categorya::where('caid','=',$caid)->find();
            $this->assign('cas_data',$cas_data);
            return $this->fetch();
        }
    }
    //资讯一级分类删除
    public function delmarketone(Request $request){
        if($request->isAjax()){
            $caid = $request->param('caid');
            $cbs = Categoryb::where('ca_id','=',$caid)->select();
            if(empty($cbs)){
                $resa = Categorya::Where('caid','=',$caid)->delete();
                if($resa){
                    return true;
                }else{
                    return false;
                }
            }else{
                $resb = Categoryb::where('ca_id','=',$caid)->delete();
                if($resb){
                    $resa = Categorya::Where('caid','=',$caid)->delete();
                    if($resa){
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }
    }
    //资讯二级分类添加
    public function addmarkettwo(Request $request)
    {
        if($request->isPost()){
            $cas = Categorya::where('cgall','=',0)->select();
            $this->assign([
                'cas' => $cas,
            ]);
            $data = $request->param();

            $rules = [
                'cbname' => 'require|unique:categoryb,cbname',
                'ca_id' => 'require|notIn:-1'
            ];
            $msg = [
                'cbname.require' => '二级分类名称必填',
                'cbname.unique' => '二级分类名称不能重复',
                'ca_id.notIn' => '一级分类名称必选'
            ];
            $validate = new Validate($rules,$msg);
            if($validate->batch()->check($data)){
                $categoryb = new Categoryb();
                $result = $categoryb->allowField(true)->save($data);
                if($result){
                    $this->success('添加成功!');
                }else{
                    $this->error('添加失败');
                }
            }else{
                $errorinfo=$validate->getError();
                $this -> assign('errorinfo',$errorinfo);
            }
        }else{
            $cas = Categorya::where('cgall','=',0)->select();
            $this->assign([
                'cas' => $cas,
            ]);
        }
        return $this->fetch();
    }
    //资讯二级修改
    public function altermarkettwo(Request $request){
        $cbid = $request->param('id');
        if($request->isPost()){
            $cbs = $request->param();
            $rules = [
                'cbname' => 'require|unique:categoryb,cbname'
            ];
            $msg = [
                'cbname.require' => '二级分类名称必填',
                'cbname.unique' => '二级分类名称不能重复',

            ];
            $validate = new Validate($rules,$msg);
            if(!$validate->batch()->check($cbs)){
                $cbs_data = Categoryb::where('cbid','=',$cbid)->find();
                $this->assign('cbs_data',$cbs_data);
                $errorinfo=$validate->getError();
                $this -> assign('errorinfo',$errorinfo);
                return $this->fetch();
            }
            $data['cbname'] = $cbs['cbname'];
            $categoryb = new Categoryb();
            $result = $categoryb->where('cbid','=',$cbid)->update($data);
            if($result){
                $this->success('更新成功!');
            }else{
                $this->error('更新失败');
            }
        }else{
            $cbs_data = Categoryb::where('cbid','=',$cbid)->find();
            $this->assign('cbs_data',$cbs_data);
            return $this->fetch();
        }
    }
    //资讯二级分类删除
    public function delmarkettwo(Request $request){
        if($request->isAjax()){
            $data = $request->param('cbid');
            $res = Categoryb::where('cbid','=',$data)->delete();
            if($res){
                return true;
            }else{
                return false;
            }
        }
    }
    //热点资讯发布
    public function publishhotmarket()
    {
        return $this->fetch();
    }
    //资讯添加
    public function publishmarket()
    {
        return $this->fetch();
    }
    //修改热点行情
    public function updatehotmarket()
    {
        return $this->fetch();
    }
    //修改价格行情
    public function updatemarket()
    {
        return $this->fetch();
    }
}
