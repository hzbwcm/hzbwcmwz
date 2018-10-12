<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\company_info;
use think\Session;



class UserController extends Controller
{
    //后台登陆页面
    public function login(Request $request)
    {
        if($request->isPost())
            {
                $name = $request->param('username');
                $pwd  = md5($request->param('pwd'));
                $exists =   company_info::where(['username'=>$name,'pwd'=>$pwd])->find();
                if($exists){
                    Session::set('com_id',$exists->com_id);
                    Session::set('username',$exists->username);
                    Session::set('company_name',$exists->company_name);
                    $this ->redirect('admin/index/index');
                }else{
                    $this -> assign ('errorinfo','用户名或密码不正确');
                }

            }
        return $this->fetch();
    }
    //后台推出
    public function logout()
    {
        Session::clear();
        $this -> redirect('admin/user/login');
    }

    //展示管理员
    public function guanliyuan()
    {
        return $this->fetch();
    }
}
