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
        dump($Zid);
        dump($Dname);
        if(!empty($Zid)){
            if(!empty($Dname)){
                $page = Customgood::where('type_xj',$Zid)->where('cus_place','like','%'.$Dname.'%')->order('cus_id desc')->paginate(6);
                if(!empty($page)){
                    for($i=mb_strlen($Dname);$i>=0;){
                        $Dname1 = mb_substr($Dname,0,-1,'utf-8');
                        $i = mb_strlen($Dname1);
                        $page = Customgood::where('type_xj',$Zid)->where('cus_place','like','%'.$Dname1.'%')->order('cus_id desc')->paginate(6);
                        if(!empty($page)){
                            break;
                        }
                    }
                }
            }else{
                $Zid = Session('Zid');
                $page = Customgood::where('type_xj',$Zid)->order('cus_id desc')->paginate(6);
            }
        }else{
            if(!empty($Dname)){
                $Dname = Session('Dname');
                $page = Customgood::where('cus_place','like','%'.$Dname.'%')->order('cus_id desc')->paginate(6);
                if(!empty($page)){
                    for($i=mb_strlen($Dname);$i>=0;){
                        $Dname1 = mb_substr($Dname,0,-1,'utf-8');
                        $i = mb_strlen($Dname1);
                        $page = Customgood::where('cus_place','like','%'.$Dname1.'%')->order('cus_id desc')->paginate(6);
                        if(!empty($page)){
                            break;
                        }
                    }
                }
            }else{
                $page = Customgood::order('cus_id desc')->paginate(6);
            }
        }

//        $customgood = new customgood();
//        $data = $customgood->select();
        //获得分页的页码列表信息 并传递给模板
        $pagelist = $page->render();
        $this->assign('pagelist',$pagelist);
        $this->assign('data',$page);





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
        return $this->fetch();
    }
}
