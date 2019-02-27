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

        $lbt = '';
        $this->assign('lbt',$lbt);
        
        
        $user_person = new user_person;
//        $loginid =str_split($cusid);
//        print_r($user['cus_fav']);
//        dump($user['cus_fav']);die;
        //当用户登录成功，如果无收藏任一个产品，为空
        $cusid1 = $request->param('cusid');
        $cusid2 = $request->param('cusid');
        $this->assign('cusid1',$cusid);
        $this->assign('cusid2',$cusid);
        if($request->isAjax()){
            if(empty($user['cus_fav'])){
                //存储第一个收藏
                $shuju['cus_fav'] = $cusid1;
                $result = $user_person -> where('user_id',$user_id)->update($shuju);
                if($result){
                    return ['fhz'=>200,'info'=>'收藏成功','cusid'=>$cusid1,'fhxx'=>1];
                }else{
                    return ['fhz'=>'failure','errorinfo'=>'收藏失败'];
                }
                //已有收藏，判断当前产品是否存在数据库
            }elseif(in_array($cusid,explode(',',$user['cus_fav']))){
                //判断传值2是否为空，为空则不运行，不为空，则删除
                if(!empty($cusid2)){
                    $data = explode(',',$user['cus_fav']);
                    foreach ($data as $k=>$v){
                        if($cusid == $v) unset($data[$k]);
                    }
                    $data = implode(',',$data);
                    $shuju['cus_fav'] = $data;
                    $result = $user_person->where('user_id',$user_id)->update($shuju);
                    if($result){
                        return ['fhz'=>200,'info'=>'取消收藏成功','cusid'=>$cusid1,'fhxx'=>2];
                    }else{
                        return ['fhz'=>'failure','errorinfo'=>'取消收藏失败'];
                    }

                }


                //已有产品收藏，但当前页没有收藏过，
            }else{
//            $cus_fav = implode(',',$user['cus_fav']);
                $cus_fav = User_person::value("concat(cus_fav,',',$cusid1)");
//            $cus_fav = json($cus_fav);
//            echo '<pre>';
                $shuju['cus_fav'] = $cus_fav;
                $result = $user_person->where('user_id',$user_id)->update($shuju);
                if($result){
                    return ['fhz'=>200,'info'=>'收藏成功','cusid'=>$cusid1,'fhxx'=>1];
                }else{
                    return ['fhz'=>'failure','errorinfo'=>'收藏失败'];
                }
            }

        }
        return $this->fetch();
    }
}
