<?php

namespace app\admin\controller;

use app\admin\model\Attribute;
use app\admin\model\Type;
use think\Controller;
use think\Request;
use think\Validate;

class AttributeController extends Controller
{
    public function index(){

        $info = Attribute::with('type')->select();

        $this -> assign('info',$info);

        return $this->fetch();
    }
    public function add(Request $request)
    {
        if($request->isPost()){
            //收集数据
            $shuju = $request->post();

            $rules = [
                'attr_name' => 'require',
                'type_id' => 'require',
            ];
            //错误提示
            $notices = [
                'attr_name.require'=>'属性名称必填',
                'type_id.require'=>'归属类型必选',
            ];
            $validate = new Validate($rules,$notices);//实例化验证对象
            if($validate->batch()->check($shuju)){
                //存储
                $type = new Attribute();
                $result = $type->allowField(true)->save($shuju); //返回添加个数
                if($result){
                    return ['status'=>'success'];
                }else{
                    return ['status'=>'failure','errorinfo'=>'数据写入失败，请联系管理员'];
                }
            }else{
                //验证不通过
                $errorinfo = $validate->getError();
                //把$errorinfo由"数组"变为"字符串"
                $errorinfo = implode(',',$errorinfo);
                return ['statuc'=>'failure','errorinfo'=>$errorinfo];
            }
        }
        else
        {
            //获得可供选取的“类型”
            $typeinfo = Type::field('type_id,type_name')->select();
            $this -> assign('typeinfo',$typeinfo);

            return $this -> fetch();
        }
        return $this->fetch();
    }

    public function getAttributeByType(Request $request)
    {
        //获得"类型id"信息
        $type_id = $request->param('type_id');
        //获得属性信息
        //①根据$type_id获得对应的属性信息
        //②$type_id为空，就获得全部的属性信息
        if(empty($type_id)){
            $attr_info = Attribute::with('type')
                ->field('attr_id,attr_name,attr_sel,attr_vals,type_id')
                ->select();
        }else{
            $attr_info = Attribute::where('type_id',$type_id)
                ->with('type')
                ->field('attr_id,attr_name,attr_sel,attr_vals,type_id')
                ->select();
        }
        return $attr_info;
    }

}
