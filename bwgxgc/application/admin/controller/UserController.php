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
    public function gerenxinxi()
    {
        $type = ['卫生巾','婴儿纸尿裤','成人纸尿裤','湿纸巾','生活用纸','产妇巾','经期裤','护理垫','宠物垫','乳垫'];
        $zjnum = ['1-5','6-10','11-15','16-20','20以上'];
        $znum = ['1-50','51-100','101-150','151-200','200以上'];
        $com_id = session('com_id');
        $info = Company_info::where('com_id', $com_id)->find();
        $this->assign([
            'info'  => $info,
            'type' => $type,
            'zjnum'=>$zjnum,
            'znum'=>$znum
        ]);

        return $this->fetch();
    }

    //个人图片上传
    public function gerentupian()
    {
        return $this->fetch();
    }

    //企业资质
    public function qiyezizhi()
    {
        return $this->fetch();
    }

    //更改企业信息
    public function tjgrxx(Request $request)
    {
        $type = ['卫生巾','婴儿纸尿裤','成人纸尿裤','湿纸巾','生活用纸','产妇巾','经期裤','护理垫','宠物垫','乳垫'];
        $zjnum = ['1-5','6-10','11-15','16-20','20以上'];
        $znum = ['1-50','51-100','101-150','151-200','200以上'];
        $com_id = session('com_id');
        $info = Company_info::where('com_id', $com_id)->find();
        $this->assign([
            'info'  => $info,
            'type' => $type,
            'zjnum'=>$zjnum,
            'znum'=>$znum
        ]);
     $shuju = [];
     $shuju['company_name'] = $request->param('company_name');
     $shuju['address'] = $request->param('address');
     $shuju['email'] = $request->param('email');
     $shuju['man'] = $request->param('man');
     $shuju['tel'] = $request->param('tel');
     $shuju['qq'] = $request->param('qq');
     $shuju['size'] = $request->param('size');
     $shuju['type'] = $request->param('type');
     $shuju['time'] = $request->param('time');
     $shuju['introduce'] = $request->param('introduce');
     $shuju['zjnum'] = $request->param('zjnum');
     $shuju['znum'] = $request->param('znum');

        $com_id = session('com_id');
        $company_info = new company_info();
        $res = $company_info->where('com_id', $com_id)->update($shuju);

        //返回结果
        if ($res) {
            return 1;
        }else{
            return 0;
        }


        return $this->fetch();

    }
}
