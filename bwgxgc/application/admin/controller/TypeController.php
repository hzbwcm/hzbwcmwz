<?php

namespace app\admin\controller;

use app\admin\model\Type;
use think\Controller;
use think\Request;
use think\Validate;

class TypeController extends Controller
{
    //列表展示
    public function index()
    {
        $info = Type::select();
        $this -> assign('info',$info);
        return $this -> fetch();
    }
    public function addition(Request $request){
        if($request->ispost()){
            $shuju = $request->post();
            $rule = [
                'type_name' => 'require|unique:type',
            ];
            $notices = [
                'type_name.require'=>'类型名称必填',
                'type_name.unique'=>'类型名称已被占用',
            ];
            $validate = new Validate($rule,$notices);
            if($validate->batch()->check($shuju)){
                $type = new Type();
                $result = $type->allowField(true)->save($shuju);
                if($result){
                    return ['status'=>'success'];
                }else{
                    return ['status'=>'failure','errorinfo'=>'数据写入失败，请联系管理员'];
                }
            }else{
                $errorinfo = $validate->getError();
                $errorinfo = implode(',',$errorinfo);
                return ['status'=>'failue','errorinfo'=>$errorinfo];
            }
        }else{
            return $this -> fetch();
        }
    }
}
