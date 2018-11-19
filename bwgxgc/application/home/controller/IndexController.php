<?php
namespace app\home\controller;

use app\home\model\Com_pic;
use think\Controller;
use app\home\model\Area;
use app\home\model\Company_info;
use think\Session;
class IndexController extends Controller
{
    //前台首页
    public function index()
    {
        $com = Company_info::where('role_id',30)->select();
        for($x=0;$x<count($com);$x++)
        {

            $pics = Com_pic::where('com_id',$com[$x]['com_id'])->find();
            $com[$x]['pic6'] =$pics['pic6'];
            $com[$x]['pic5'] =$pics['pic5'];
            $com[$x]['pic9'] =$pics['pic9'];
        }



        $this->assign('com',$com);
        return $this->fetch();
    }





    //前台页脚
    public function foot_base()
    {
        return $this->fetch();
    }

    //网络批发
    public function wlpf()
    {
        return $this->fetch();
    }

    //杂志
    public function magazine()
    {
        return $this->fetch();
    }

    //收藏夹
    public function shoucangjia()
    {
        return $this->fetch();
    }
    //收藏夹
    public function sousuo()
    {
        return $this->fetch();
    }

}