<?php

namespace app\admin\controller;

use app\admin\model\Company_info;
use app\admin\model\Permission;
use think\Controller;

class IndexController extends Controller
{
    //后台首页
    public function index()
    {
        $com_id = session('com_id');
//        $username = session('username');

        if($com_id===1){
            $ps_infoA = Permission::where('ps_level','0')->select();
            $ps_infoB = Permission::where('ps_level','1')->select();
        }else{
            $ps_ids = Company_info::alias('c')
                ->join('role r','c.role_id=r.role_id')
                ->where('c.com_id',$com_id)
                ->value('r.role_ps_ids');

            $ps_infoA = Permission::where('ps_id','in',$ps_ids)
                ->where('ps_level','0')
                ->select();
            $ps_infoB = Permission::where('ps_id','in',$ps_ids)
                ->where('ps_level','1')
                ->select();
        }

        $this -> assign('ps_infoA',$ps_infoA);
        $this -> assign('ps_infoB',$ps_infoB);

        return $this->fetch();
    }
    //后台welcome
    public function welcome()
    {
        return $this->fetch();
    }
}
