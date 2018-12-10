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
            $info = $request->post();
            $cus_pic = request()->file('cus_pic');
            $data  = $cus_pic  ? $cus_pic->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'customgood') : '';
            $cus_pic1 = request()->file('cus_pic1');
            $data1 = $cus_pic1 ? $cus_pic1->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'customgood') : '';
            $cus_pic2 = request()->file('cus_pic2');
            $data2 = $cus_pic2 ? $cus_pic2->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'customgood') : '';
            $cus_pic3 = request()->file('cus_pic3');
            $data3 = $cus_pic3 ? $cus_pic3->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'customgood') : '';
            if($data){
                $data = $data ? $data->getSaveName() : '';
                $data = $data ? 'customgood' . "/" .  $data : '';
                $pic = Customgood::where('cus_id',$id)->value('cus_pic');
                $filename = ROOT_PATH . 'public/uploads' . '/' . $pic;
                if(file_exists($filename)){
                    unlink($filename);
                }else{
                    return  '我已经被删除了哦！';
                }

            }else if($cus_pic){
                $this->error('主图上传失败' . '：' . $cus_pic->getError(),'user/fabuxinxi');
            }
            if($data1){
                $data1 = $data1 ? $data1->getSaveName() : '';
                $data1 = $data1 ? 'customgood' . "/" .  $data1 : '';

                Db('Customgood')->where('cus_id',$id)->delete('cus_pic1');
            }else if($cus_pic1){
                $this->error('副图1上传失败' . '：' . $cus_pic1->getError(),'user/fabuxinxi');
            }
            if($data2){
                $data2 = $data2 ? $data2->getSaveName() : '';
                $data2 = $data2 ? 'customgood' . "/" . $data2 : '';
            }else if($cus_pic2){
                $this->error('副图2上传失败' . '：' . $cus_pic2->getError(),'user/fabuxinxi');
            }
            if($data3){
                $data3 = $data3 ? $data3->getSaveName() : '';
                $data3 = $data3 ? 'customgood' . "/" .  $data3 : '';
            }else if($cus_pic3){
                $this->error('副图3上传失败' . '：' . $cus_pic3->getError(),'user/fabuxinxi');
            }

            $rules = [
                'cus_proname'          =>'require',
                'cus_length'           =>'require',
            ];
            $msg = [
                'cus_proname.require'      => '必填',
                'cus_length.require'       => '必填',
            ];
            $validate = new Validate($rules,$msg);
            if(!$validate->batch()->check($info)){
                $user_data = Customgood::where('user_id', $user_id)->where('cus_id',$id)->find();
                //根据所点击定制产品的type_id,type_xj获取到TYPE中的type_name
                //获取父类
                $type_data1 = Type::where('type_id',$user_data['type_id'])->find();
                //获取子类
                $type_data2 = Type::where('type_id',$user_data['type_xj'])->find();
                //子类下拉框
                $type_data22 = Type::where('type_pid',$user_data['type_id'])->select();

                $this->assign('user_data', $user_data);
                $this->assign('type_data1',$type_data1);
                $this->assign('type_data2',$type_data2);
                $this->assign('type_data22',$type_data22);
                $errorinfo=$validate->getError();
                $this -> assign('errorinfo',$errorinfo);
                return $this -> fetch();
            }

            $Customgood = new Customgood();
            $info['cus_pic'] = $data;
            $info['cus_pic1'] = $data1;
            $info['cus_pic2'] = $data2;
            $info['cus_pic3'] = $data3;
            $info = array_filter($info);

            $res = $Customgood->where('cus_id',$id)->update($info);
            if ($res) {

                $request = Request::instance();
                $ip = $request->ip();
                $acc = Session::get('username');
                $da = [
                    'ope_cat' => '个人',
                    'ope_id' => $user_id,
                    'ope_acc'=> $acc,
                    'ope_ip'=> $ip,
                    'ope_tab'=> 'customgood',
                    'ope_act' => '修改',
                ];
                Db::table('ope_log')->insert($da);
                return $this->success('发布成功',"user/xinxiguanlishouye");
            }else{
                $this->error('信息更新失败!','user/xinxiguanlishouye');
            }
        }else{
            //获取所点击的产品定制信息
            $user_data = Customgood::where('user_id', $user_id)->where('cus_id',$id)->find();
            //根据所点击定制产品的type_id,type_xj获取到TYPE中的type_name
            //获取父类
            $type_data1 = Type::where('type_id',$user_data['type_id'])->find();
            //获取子类
            $type_data2 = Type::where('type_id',$user_data['type_xj'])->find();
            //子类下拉框
            $type_data22 = Type::where('type_pid',$user_data['type_id'])->select();

            $this->assign('user_data', $user_data);
            $this->assign('type_data1',$type_data1);
            $this->assign('type_data2',$type_data2);
            $this->assign('type_data22',$type_data22);
            return $this->fetch();
        }
    }

    //产品定制删除
    public function delcpdz(Request $request)
    {
        $user_id = Session::get('user_id');
        $cusid = $request ->get('cusid');
        $res = Customgood::where('cus_id',$cusid)->find()->delete();
        if ($res) {

            $request = Request::instance();
            $ip = $request->ip();
            $acc = Session::get('username');
            $data = [
                'ope_cat' => '个人',
                'ope_id' => $user_id,
                'ope_acc'=> $acc,
                'ope_ip'=> $ip,
                'ope_tab'=> 'customgood',
                'ope_act' => '删除',
            ];
            Db::table('ope_log')->insert($data);

            return true;
        } else {
            return false;
        }
    }

    //信息管理首页
    public function xinxiguanlishouye(Request $request)
    {

        $user_id = session('user_id');

        //获取侧导航元素
        $type= new Type();
        $left_data = $type->where('type_pid',0)->select();

        //遍历定制产品信息根据user_id及type_id
        $type_pid = empty($request->param('pid')) ? 1 : $request->param('pid');
        $info = Customgood::where('user_id',$user_id)->where('type_id',$type_pid)->select();

        $this->assign('left_data',$left_data);
        $this->assign('pid',$type_pid);
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

        $name = User_person::where('user_id',$user_id)->value('nickname');
        if(request()->isPost()){
            $shuju = Request::instance()->param();
            $cus_pic = request()->file('cus_pic');
            $data  = $cus_pic  ? $cus_pic->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'customgood') : '';
            $cus_pic1 = request()->file('cus_pic1');
            $data1 = $cus_pic1 ? $cus_pic1->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'customgood') : '';
            $cus_pic2 = request()->file('cus_pic2');
            $data2 = $cus_pic2 ? $cus_pic2->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'customgood') : '';
            $cus_pic3 = request()->file('cus_pic3');
            $data3 = $cus_pic3 ? $cus_pic3->validate(['size'=>512000,'ext'=>'jpg,jpeg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'customgood') : '';
            if($data){
                $data = $data ? $data->getSaveName() : '';
                $data = $data ? 'customgood' . "/" .  $data : '';
            }else if($cus_pic){
                $this->error('主图上传失败' . '：' . $cus_pic->getError(),'user/fabuxinxi');
            }

            if($data1){
                $data1 = $data1 ? $data1->getSaveName() : '';
                $data1 = $data1 ? 'customgood' . "/" .  $data1 : '';
            }else if($cus_pic1){
                $this->error('副图一上传失败' . '：' . $cus_pic1->getError(),'user/fabuxinxi');
            }
            if($data2){
                $data2 = $data2 ? $data2->getSaveName() : '';
                $data2 = $data2 ? 'customgood' . "/" . $data2 : '';

            }else if($cus_pic2){
                $this->error('副图二上传失败' . '：' . $cus_pic2->getError(),'user/fabuxinxi');
            }
            if($data3){
                $data3 = $data3 ? $data3->getSaveName() : '';
                $data3 = $data3 ? 'customgood' . "/" .  $data3 : '';
            }else if($cus_pic3){
                $this->error('副图三上传失败' . '：' . $cus_pic3->getError(),'user/fabuxinxi');
            }

            $rules = [
                'cus_proname'          =>'require',
            ];
            $msg = [
                'cus_proname.require'      => '必填',
            ];
            $validate = new Validate($rules,$msg);
            if(!$validate->batch()->check($shuju)){
                $errorinfo=$validate->getError();
                $this -> assign('errorinfo',$errorinfo);
                return $this -> fetch();
            }
            $shuju['user_id'] = $user_id;
            $shuju['type_id'] = $shuju['pid'];
            $shuju['type_xj'] = $shuju['classify_id'];
            $shuju['issue_name'] = $name;
            $shuju['cus_pic'] = $data;
            $shuju['cus_pic1'] = $data1;
            $shuju['cus_pic2'] = $data2;
            $shuju['cus_pic3'] = $data3;
            $shuju = array_filter($shuju);
            $customgood = new Customgood();
            $result = $customgood->allowField(true)->save($shuju);
            if($result){
                $request = Request::instance();
                $ip = $request->ip();
                $acc = Session::get('username');
                $da = [
                    'ope_cat' => '个人',
                    'ope_id' => $user_id,
                    'ope_acc'=> $acc,
                    'ope_ip'=> $ip,
                    'ope_tab'=> 'customgood',
                    'ope_act' => '添加',
                ];
                Db::table('ope_log')->insert($da);

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
            ];
            $msg = [
                'nickname.require'      => '用户名必填',
                'nickname.unique'       => '用户名已经被使用',
                'nickname.max'          => '用户名长度不能超过25位',
                'tel.require'           => '手机号码必填',
                'tel.regex'             => '手机号码规则不正确',
                'user_email.require'    => '邮箱必填',
                'user_email.email'      => '邮箱格式不正确',
            ];
            $validate = new Validate($rules,$msg);
            if(!$validate->batch()->check($data)){
                $user_data = User_person::where('user_id', $user_id)->find();
                $this->assign('user_data', $user_data);
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
                'nickname'      =>'require|unique:user_person,username|max:25',
            ];
            $msg = [
                'nickname.require'      => '用户名必填',
                'nickname.unique'       => '用户名已经被使用',
                'nickname.max'          => '用户名长度不能超过25位',
                'username.require'      => '账号必填',
                'username.unique'       => '账号已经被使用',
                'username.max'          => '账号长度不能超过25位',
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





















