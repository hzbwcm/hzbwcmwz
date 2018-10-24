<?php

namespace app\admin\controller;

use app\admin\model\Permission;
use think\Controller;
use think\Request;
use think\Validate;

class PermissionController extends Controller
{
    /**
     * 显示资源列表
     * @return \think\Response
     */
    public function index()
    {
        //获得权限列表信息
        $info = Permission::select();
        $arr = [];
        foreach($info as $v){
            //toArray()可以把"数据model对象"变为"纯数组"的样子
            $arr[] = $v->toArray();
        }
        //dump($arr);  //纯二维数组
        //把组织好的二维数组权限数据传递给下述函数，整理变为上级下关系
        $shuju = generateTree($arr);
        //dump($shuju);//有上下级关系的权限纯二维数组信息

        $this -> assign('info',$shuju);
        return $this -> fetch();
    }

    /**
     * 添加权限
     */
    public function addition(Request $request)
    {
        if($request -> isPost()){

            $shuju = $request->post();

            $rules = [
                'ps_name' => 'require',
            ];
            $notices = [
                'ps_name.require' => '权限名称必填',
            ];
            $validate = new Validate($rules,$notices);
            if($validate->batch()->check($shuju)){
                if($shuju['ps_pid']==0){
                    $shuju['ps_level'] = '0';
                }else{
                    $p_level = Permission::where('ps_id',$shuju['ps_pid'])->value('ps_level');
                    $shuju['ps_level'] = $p_level+1;
                }

                $permission = new Permission();
                $result = $permission->allowField(true)->save($shuju);//返回添加的个数
                if($result){
                    return ['status'=>'success'];
                }else{
                    return ['status'=>'failure','errorinfo'=>'数据写入失败，请联系管理员'];
                }
            }else{
                $errorinfo = $validate->getError();
                return ['status'=>'failure','errorinfo'=>implode(',',$errorinfo)];
            }
        }else{
            $ps_infoAB = Permission::where('ps_level','in','0,1')
                ->select();

            $arr = [];
            foreach($ps_infoAB as $v){
                $arr[] = $v->toArray();
            }
            $info = generateTree($arr);
            $this -> assign('info',$info);

            return $this -> fetch();
        }
    }
}




