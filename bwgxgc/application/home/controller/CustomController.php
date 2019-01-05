<?php

namespace app\home\controller;




use think\Controller;
use app\home\model\Customgood;
use app\home\model\User_person;
use app\home\model\Company_info;
use think\Request;
use think\Session;
use app\home\model\Area;
use app\home\model\Type;

class CustomController extends Controller
{
    public function Custom(Request $request)
    {

        $info = Area::where('Pid',0)->select();
        $type = Type::select();
        $this->assign([
            'info'  => $info,
            'type' => $type
        ]);

        $bzid = $request->param('bzid') ? $request->param('bzid') : null;
        if(empty($bzid)){
            session('Zid',null);
            session('Dname',null);
        }

        $Zid = $request->param('zid')?$request->param('zid'):Session('Zid');
        Session::set('Zid',$Zid);
        $Dname = $request->param('dname')?$request->param('dname'):Session('Dname');
        Session::set('Dname',$Dname);
        if($Zid==-1){
            session('Zid',null);
            $Zid = null;

        }
        if($Dname==-1){
            session('Dname',null);
            $Dname = null;
        }
        if(!empty($Zid)){
            if(!empty($Dname)){
                $page = Customgood::where('type_xj',$Zid)->where('cus_place','like','%'.$Dname.'%')->order('cus_id desc')->paginate(8);
                if(!empty($page)){
                    for($i=mb_strlen($Dname);$i>=0;){
                        $Dname1 = mb_substr($Dname,0,-1,'utf-8');
                        $i = mb_strlen($Dname1);
                        $page = Customgood::where('type_xj',$Zid)->where('cus_place','like','%'.$Dname1.'%')->order('cus_id desc')->paginate(8);
                        if(!empty($page)){
                            break;
                        }
                    }
                }
            }else{
                $Zid = Session('Zid');
                $page = Customgood::where('type_xj',$Zid)->order('cus_id desc')->paginate(8);
            }
        }else{
            if(!empty($Dname)){
                $Dname = Session('Dname');
                $page = Customgood::where('cus_place','like','%'.$Dname.'%')->order('cus_id desc')->paginate(8);
                if(!empty($page)){
                    for($i=mb_strlen($Dname);$i>=0;){
                        $Dname1 = mb_substr($Dname,0,-1,'utf-8');
                        $i = mb_strlen($Dname1);
                        $page = Customgood::where('cus_place','like','%'.$Dname1.'%')->order('cus_id desc')->paginate(8);
                        if(!empty($page)){
                            break;
                        }
                    }
                }
            }else{
                $page = Customgood::order('cus_id desc')->paginate(8);
            }
        }

        $type1 = Type::where('type_id',$Zid)->find();
        $this->assign('type1',$type1);

        //获得分页的页码列表信息 并传递给模板
        $pagelist = $page->render();
        $this->assign('pagelist',$pagelist);
        $this->assign('data',$page);

        $Dna = '';
        $this->assign('Dna',$Dna);
        $this->assign('Zid',$Zid);
        $this->assign('Dname',$Dname);

        return $this->fetch();

    }

    public function Customizing(Request $request)
    {
        $cusid = $request->param('cusid');

        $customgood = new customgood();
        $data = $customgood->where('cus_id',$cusid)->find();

        $this->assign('data',$data);

        $type = new type();
        $type1 = $type->where('type_id',$data['type_id'])->value('type_name');
        $this->assign('type1',$type1);

        $user_id = Session('user_id');
        $user = User_person::where('user_id',$user_id)->find();
        $this->assign('user',$user);

        $user_person = new user_person;

//        $loginid =str_split($cusid);
//        print_r($user['cus_fav']);
//        dump($user['cus_fav']);die;
        if(empty($user['cus_fav'])){
            $shuju['cus_fav'] = json($cusid);
            $result = $user_person -> where('user_id',$user_id)->update($shuju);
            if($result){
//                return ['status'=>'200'];
            }else{
//                return ['status'=>'failure','errorinfo'=>'收藏失败'];
            }
        }elseif(in_array($cusid,str_split($user['cus_fav']))){
//            return ['status'=>'200'];

        }else{
//            $cus_fav = implode(',',$user['cus_fav']);
            $cus_fav = User_person::value("concat(cus_fav,',',$cusid)");
//            $cus_fav = json($cus_fav);
//            echo '<pre>';

            $shuju['cus_fav'] = $cus_fav;
            $result = $user_person->where('user_id',$user_id)->update($shuju);
            if($result){
//                return ['status'=>'200'];
            }else{
//                return ['status'=>'failure','errorinfo'=>'收藏失败'];
            }
        }




        return $this->fetch();
    }
}
