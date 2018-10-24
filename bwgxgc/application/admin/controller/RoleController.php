<?php

namespace app\admin\controller;

use app\admin\model\Permission;
use app\admin\model\Role;
use think\Controller;
use think\Request;
use think\Validate;
use app\admin\behavior\CheckLogin;

class RoleController extends Controller
{
    //角色表
    public function index()
    {
        $info = Role::select();
        $this -> assign('info',$info);
        return $this->fetch();
    }
    public function gai(Request $request,Role $role)
    {
        if($request->isPost()){
            $form_datas = $request->param();
            $rules = [
                'role_name'=>'require',
                'quanxian'=>'require|min:2',
            ];
            $notices = [
                'role_name.require'=>'角色名称必填',
                'quanxian.require'=>'权限必选',
                'quanxian.min'=>'权限必选(两个或以上)',
            ];
            $validate = new Validate($rules,$notices);


            if($validate->batch()->check($form_datas)){
                $role_ps_ids = implode(',',$form_datas['quanxian']);
                $cas = Permission::where('ps_id','in',$role_ps_ids)
                    ->where('ps_level','neq','0')
                    ->column("concat(ps_c,'-',ps_a) as ca");
                $str_cas = implode(',',$cas);

                $shuju['role_id']       = $form_datas['role_id'];
                $shuju['role_name']     = $form_datas['role_name'];
                $shuju['role_ps_ids']   = $role_ps_ids;
                $shuju['role_ps_ca']    = $str_cas;

                $result = $role -> update($shuju);
                if($result){
                    return ['status'=>'success'];
                }else{
                    return ['status'=>'failure','errorinfo'=>'内部错误，请联系管理员'];
                }
            }else{
                $errorinfo = $validate->getError();
                return ['status'=>'failure','errorinfo'=>implode(',',$errorinfo)];
            }
        }else{
            $this -> assign('role',$role);

            $ps_infoA = Permission::where('ps_level','0')->select();
            $ps_infoB = Permission::where('ps_level','1')->select();
            $ps_infoC = Permission::where('ps_level','2')->select();
            $this -> assign('ps_infoA',$ps_infoA);
            $this -> assign('ps_infoB',$ps_infoB);
            $this -> assign('ps_infoC',$ps_infoC);

            return $this -> fetch();
        }
    }
}
