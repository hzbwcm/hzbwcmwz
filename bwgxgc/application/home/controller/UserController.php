<?php
namespace app\home\controller;

use app\admin\model\Customgood;
use app\admin\model\User;
use app\home\model\Company_info;
use app\home\model\User_person;
use app\admin\model\Type;
use think\Controller;
use think\Request;
use think\Session;
use think\Validate;
use think\Db;

use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;

class UserController extends Controller
{

    //信息管理
    public function xinxiguanli($id,Request $request)
    {
        $user_id = session('user_id');
        Session::get($id);
        if($request->isPost()){

            $data = $request->post();
            $rules = [
                'cus_proname'          =>'require',
                'cus_length'           =>'require',
                'cus_width'            =>'require',
                'cus_place'            =>'require',
                'cus_supply'           =>'require',
                'cus_orders'           =>'require',
            ];
            $msg = [
                'cus_proname.require'      => '必填',
                'cus_length.require'       => '必填',
                'cus_width.require'        => '必填',
                'cus_place.require'        => '必填',
                'cus_supply.require'       => '必填',
                'cus_orders.require'       => '必填',

            ];
            $validate = new Validate($rules,$msg);
            if(!$validate->batch()->check($data)){
                $errorinfo=$validate->getError();
                $this -> assign('errorinfo',$errorinfo);
                return $this -> fetch();
            }
            $Customgood = new Customgood();
            $res = $Customgood->where('cus_id',$id)->update($data);
            if ($res) {
                return $this->success('发布成功',"user/xinxiguanlishouye");
            }else{
                $this->error('信息更新失败!');
            }
        }else{
            $user_data = Customgood::where('user_id', $user_id)->where('cus_id',$id)->find();
            $this->assign('user_data', $user_data);
            return $this->fetch();
        }
    }
    //信息管理首页
    public function xinxiguanlishouye(Request $request)
    {
        $user_id = session('user_id');

        //获取侧导航元素
        $type= new Type();
        $left_data = $type->where('type_pid',0)->select();

        //遍历定制产品信息根据user_id
        $type_pid = empty($request->param('pid')) ? 1 : $request->param('pid');
        $info = Customgood::where('user_id',$user_id)->select();

        $this->assign('left_data',$left_data);
        $this->assign('info',$info);
        return $this->fetch();
    }
    //发布信息get_type_info
    public function fabuxinxi(Request $request)
    {
        //获取用户id
        $user_id = session('user_id');
        //获取一级元素
        $type = new Type();
        $left_data = $type->where('type_pid', 0)->select();

        //获取二级分类
        $type_pid = empty($request->param('pid')) ? 1 : $request->param('pid');
        $classify_data = $type->where('type_pid', $type_pid)->select();



        $this->assign('left_data', $left_data);
        $this->assign('pid', $type_pid);
        $this->assign('classify', $classify_data);

        if(request()->isPost()){
            $shuju = Request::instance()->post();
            $rules = [
                'cus_proname'          =>'require',
                'cus_length'           =>'require',
                'cus_width'            =>'require',
                'cus_place'            =>'require',
                'cus_supply'           =>'require',
                'cus_orders'           =>'require',
            ];
            $msg = [
                'cus_proname.require'      => '必填',
                'cus_length.require'       => '必填',
                'cus_width.require'        => '必填',
                'cus_place.require'        => '必填',
                'cus_supply.require'       => '必填',
                'cus_orders.require'       => '必填',
            ];
            $validate = new Validate($rules,$msg);
            if(!$validate->batch()->check($shuju)){
                $errorinfo=$validate->getError();
                $this -> assign('errorinfo',$errorinfo);
                return $this -> fetch();
            }


            $customgood = new Customgood();
            $shuju['user_id'] = $user_id;
            $shuju['type_id'] = $shuju['pid'];
            $shuju['type_xj'] = $shuju['classify_id'];
            $result = $customgood->allowField(true)->save($shuju);
            if($result){
                return $this->success('发布成功','user/fabuxinxi');
            }else{
                return ['status'=>'failure','errorinfo'=>'数据写入失败，请联系管理员'];
            }
        }
        return $this->fetch();
    }
    //个人信息
    public function usercenter(Request $request)
    {
        $user_id = session('user_id');
        if(empty($user_id)){
            $this->error('请用个人账户登录');
        }
        if($request->isPost()){

            $data = $request->post();
            $rules = [
                'nickname'      =>'require|unique:user_person,username|max:25',
                'tel'           =>['require','regex'=>'/^1[358]\d{9}$/'],
                'user_email'    =>'require|email',
                'user_qq'       =>'require',
            ];
            $msg = [
                'nickname.require'      => '昵称必填',
                'nickname.unique'       => '昵称已经被使用',
                'nickname.max'          => '昵称长度不能超过25位',
                'tel.require'           => '手机号码必填',
                'tel.regex'             => '手机号码规则不正确',
                'user_email.require'    => '邮箱必填',
                'user_email.email'      => '邮箱格式不正确',
                'user_qq.require'       => 'qq必填',
            ];
            $validate = new Validate($rules,$msg);
            if(!$validate->batch()->check($data)){
                $errorinfo=$validate->getError();
                $this -> assign('errorinfo',$errorinfo);
                return $this -> fetch();
            }
            $user_person = new user_person();
            $res = $user_person->where('user_id', $user_id)->update($data);
            if ($res) {
                $this->success('信息更新成功!');  //TODO 更新成功页面跳转
            }else{
                $this->error('信息更新失败!');
            }
        }else{
            $user_data = User_person::where('user_id', $user_id)->find();
            $this->assign('user_data', $user_data);
            return $this->fetch();
        }
    }
    //首页页首个人中心
    public function accountcenter()
    {
        return $this->fetch();
    }

     //个人用户登录
    public function login(Request $request)
    {
        if($request->ispost())
        {
            $username = $request->param('username');
            $password  = md5($request->param('password'));
            $exists = User_person::where(['username'=>$username,'password'=>$password])->find();

            if($exists){
                //持久化用户信息Session
                Session::set('user_id',$exists->user_id);
                Session::set('username',$exists->username);
                Session::set('nickname',$exists->nickname);
                //登录系统(页面跳转)
                $this -> redirect('home/index/index');
            }else{
                $this -> assign('errorinfo','用户名或密码不正确');
            }
        }
        return $this->fetch();
    }

    //个人用户退出登录
    public function loginout()
    {
        Session::clear();
        $this->redirect('/');
    }

    public function sms()
    {
        //密钥配置
        $config = [
            'accessKeyId'    => 'LTAI1sFXgKSjS0Bn',
            'accessKeySecret' => 'lOHNoTSM5m9kOsJaiADfyDIC2gaXho',
        ];

        $client  = new Client($config);  //实例化对象
        $sendSms = new SendSms;             //实例化对象
        $sendSms->setPhoneNumbers('15735178144'); //接收短信手机号码
        $sendSms->setSignName('博卫传媒');  //短信签名设置
        $sendSms->setTemplateCode('SMS_137840067'); //短信模版设置
        //短信内容变量设置
        $code = mt_rand(100000, 999999);
        $time = 3; //有效验证时间为3分钟
        $sendSms->setTemplateParam(['code' => $code,'time'=>$time]);
        $sendSms->setOutId('demo'.time()); //发送短信序号

        print_r($client->execute($sendSms));//发送短信
    }
    /*
     * 用户登录网站发送验证码短信
     */
    public function sendsms(Request $request)
    {
        $tel = $request->post('tel');
        $config = [
            'accessKeyId'    => 'LTAI1sFXgKSjS0Bn',
            'accessKeySecret' => 'lOHNoTSM5m9kOsJaiADfyDIC2gaXho',
        ];

        $client  = new Client($config);
        $sendSms = new SendSms;
        $sendSms->setPhoneNumbers($tel);  //接收人
        $sendSms->setSignName('博卫传媒');//签名
        $sendSms->setTemplateCode('SMS_137840067');//模板

        //模板内容变量
        $code = mt_rand(100000,999999);  //6位数的验证码
        $time = 3; //有效验证时间为3分钟
        //为了后期校验，要把"验证码"  和  "时间"存到session中，用户后期比较
        session('tel_code',$code);
        session('tel_time',time()); //存储发送短信的时间戳信息


        $sendSms->setTemplateParam(['code' => $code,'time'=>$time]);
        //发送短信的序号
        $sendSms->setOutId('demo'.time());

        //正式发送短信
        $obj = $client->execute($sendSms);
        if($obj->Message=='OK'){
            return ['status'=>'success'];
        }else{
            return ['status'=>'failure'];
        }

    }


    //注册
    public function register()
    {
        return $this->fetch();
    }
     //个人注册
    public function gerenzhuce(Request $request)
    {
        if(request()->ispost()){
            $shuju = request()->param();
            $rules = [
                'username'  =>'require|unique:user_person,username|max:25',
                'password'  =>'require|length:6,15',
                'password2' =>'require|confirm:password',
                'tel'       =>['require','regex'=>'/^1[358]\d{9}$/'],
            ];
            $msg = [
                'username.require'      => '名称必填',
                'username.unique'       => '用户名已经被使用',
                'username.max'          => '用户名长度不能超过25位',
                'password.require'       => '密码必填',
                'password.length'       => '密码长度须在6到15之间',
                'password2.require'      => '确认密码必填',
                'password2.confirm'     => '两次密码不一致',
                'tel.require'           => '手机号码必填',
                'tel.regex'             => '手机号码规则不正确',
            ];
            $validate = new Validate($rules,$msg);
            if($validate ->batch()-> check($shuju)){
                $user_person = new user_person();
                $shuju['password'] = md5($shuju['password']);
                $result = $user_person->allowField(true)->save($shuju);
                if($result){
                    echo "<script>alert('恭喜您注册成功');</script>";
                    echo "<script>parent.location.href = \"../index/index\";</script>";
//                    $this->success('添加成功',('index'));
//                    return ['status'=>'success'];
                }else{
                    return $this->redirect('home/uer/zhuceshibai');
                }
            }else{
                $errorinfo= $validate->getError();
                $this -> assign('errorinfo',$errorinfo);
                $this -> assign('shuju',$shuju);
                return $this -> fetch();
            }
        }else{
            return $this->fetch();
        }

    }

    //个人注册失败
    public function zhuceshibai()
    {
        return $this->fetch();
    }

    //企业注册
    public function qiyezhuce(Request $request)
    {
        if($request->isPost()){
            $shuju = $request -> post();
            $rules = [
                'username'=>'require|unique:company_info',
                'pwd'=>'require',
                'pwd2'=>'require|confirm:pwd',
                'company_name'=>'require',
                'address'=>'require',
                'email'=>'require|email',
            ];
            $notices = [
                'username.require'=>'用户名必填',
                'username.unique'=>'用户名已被占用',
                'pwd.require'=>'密码必填',
                'pwd2.require'=>'确认密码必填',
                'pwd2.confirm'=>'两次密码不一致',
                'company_name.require'=>'公司名称必填',
                'address.require'=>'公司地址必填',
                'email.require'=>'邮箱必填',
                'email.email'=>'邮箱格式不正确',
            ];
            $validate   = new Validate($rules,$notices);
            if($validate->batch()->check($shuju)){
                $company = new company_info();
                $shuju['pwd'] = md5($shuju['pwd']);
                $result = $company ->allowField(true)->save($shuju);
                if($result){
                    //注册成功
                    $aa ='注册成功';
                    $this->assign('aa',$aa);
                    return $this->fetch();
                }else{
                    //失败
                    $aa ='注册失败';
                    $this->assign('aa',$aa);
                    return $this->fetch();
                }
            }else{
            $errorinfo= $validate->getError();
            $this->assign('errorinfo',$errorinfo);
            $this->assign('shuju',$shuju);
            return $this->fetch();
            }

    }else
        {
            return $this->fetch();
        }
    }
    //登陆




    }





















