<?php
namespace app\home\controller;

use app\home\model\company_info;
use app\home\model\User_person;
use think\Controller;
use think\Request;
use think\Session;
use think\Validate;

use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;

class UserController extends Controller
{

     //个人用户登录
    public function login(Request $request)
    {
        //判断：展示 or 收集
        if($request->ispost()){
            //收集、判断、登录
            $name = $request->param('username');
            $pwd  = md5($request->param('password'));
            //判断
            $exists = User_person::where(['username'=>$name,'password'=>$pwd])->find();//返回object null
            if(exists){
                //持久化用户信息Session
                Session::set('user_id',$exists->user_id);
                Session::set('username',$exists->username);
                //登录系统（页面跳转）
                return $this->redirect('home/user/register');
            }else{
                $this->assign('erroinfo','用户名或密码不正确');
            }
        }
        //展示 登录的表单页面
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
            //[post请求]收集form表单信息存储
            //要通过param（）收集客户上传的信息，有过滤机制，比较安全
            $shuju = request()->param();//或调用post也可以
            //对收集到的信息实现校验
            //规则制作

            $rules = [
                'username'  =>'require|unique:user_person,username|max:25',

                'password'  =>'require',
                'password2' =>'require|confirm:password',

                'tel'  =>['require','regex'=>'/^1[358]\d{9}$/'],
            ];
            //错误提示
            $msg = [
                'username.require'      => '名称必填',

                'username.unique'       => '用户名已经被使用',
                'username.max'          => '用户名长度不能超过25位',
                'password.unique'       => '密码必填',
                'password2.unique'      => '确认密码必填',
                'password2.confirm'     => '密码与确认密码不一致',
                'tel.require'           => '手机号码必填',
                'tel.regex'             => '手机号码规则不正确',
            ];
            $validate = new Validate($rules,$msg);//实例化验证对象
            if($validate ->batch()-> check($shuju)){
                //验证通过，把数据添加到数据库中
                $user_person = new User_person();
                $shuju['password'] = md5($shuju['password']);
                $result = $user_person->allowField(true)->save($shuju);//返回添加的个数
                if($result){
                    //直接返回数据信息，tp5框架底层会对该数组进行“自动”json转化，进而给客户端使用
                    return ['status'=>'success'];
                }else{
                    return ['status'=>'failure','errorinfo'=>'数据写入失败，请重新输入'];
                }
            }else{
                //验证不通过
                $errorinfo = $validate->getError();
                //把#errorinfo由“数组”变为字符串
                $errorinfo = implode('',$errorinfo);
                return ['status'=>'failure','errorinfo'=>$errorinfo];//把错误信息变为字符串返回给客户端的Ajax
            }
        }else{
            //[get请求]展示添加效果
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
        { return $this->fetch();
        }
        }
    //登陆


    }





















