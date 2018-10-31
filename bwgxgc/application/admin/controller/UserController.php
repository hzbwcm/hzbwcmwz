<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Company_info;
use think\Session;


class UserController extends Controller
{
    //后台登陆页面
    public function login(Request $request)
    {
        if ($request->isPost()) {
            $name = $request->param('username');
            $pwd = md5($request->param('pwd'));
            $exists = Company_info::where(['username' => $name, 'pwd' => $pwd])->find();
            if ($exists) {
                Session::set('com_id', $exists->com_id);
                Session::set('username', $exists->username);
                Session::set('company_name', $exists->company_name);
                $this->redirect('admin/index/index');
            } else {
                $this->assign('errorinfo', '用户名或密码不正确');
            }
        }
        return $this->fetch();
    }
    //后台推出
    public function logout()
    {
        Session::clear();
        $this->redirect('admin/user/login');
    }

    //展示管理员
    public function guanliyuan()
    {
        $info = Company_info::select();
        $this->assign('info', $info);
        return $this->fetch();
    }

      //个人信息
    public function gerenxinxi(Request $request)
    {
        $type = ['纸尿裤','卫生巾','湿纸巾'];
        $com_id = session('com_id');
        $info = Company_info::where('com_id', $com_id)->find();
        $this->assign([
            'info'  => $info,
            'type' => $type
        ]);
        return $this->fetch();
    }

}
