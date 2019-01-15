<?php

namespace app\admin\controller;

use app\admin\model\Book;
use app\admin\model\Com_pic;
use think\Controller;
use think\Request;
use app\admin\model\Company_info;
use app\admin\model\User_person;
use think\Session;


class UserController extends Controller
{
    //查询在线人数
    public function onlinecount()
    {
        $info = User_person::where('login_id','1')->select();
        $info = count($info);
        $this->assign('info',$info);
        return $this->fetch();
    }

    //后台登陆
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

    //后台退出
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
        $type = ['卫生巾', '婴儿纸尿裤', '成人纸尿裤', '湿纸巾', '生活用纸', '产妇巾', '经期裤', '护理垫', '宠物垫', '乳垫'];
        $zjnum = ['1-5', '6-10', '11-15', '16-20', '20以上'];
        $znum = ['1-50', '51-100', '101-150', '151-200', '200以上'];
        $com_id = session('com_id');
        $info = Company_info::where('com_id', $com_id)->find();
        $this->assign([
            'info' => $info,
            'type' => $type,
            'zjnum' => $zjnum,
            'znum' => $znum
        ]);

        return $this->fetch();
    }


    //企业图片
    public function gerentupian(Request $request)

    {
        $com_id = Session::get('com_id');
        if (request()->isPost()) {
            $info5 = [];
            for ($x = 1; $x < 12; $x++) {
                $file = request()->file('pic' . $x);
               
                if($file){

                    $info = $file->validate(['size'=>512000])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'com_pic');
                    if($info==false)
                    {
                        return $this->error('上传失败,请确保图片大小在500K以下，并为正规图片文件');
                    }
                    $info2 = $info->getSaveName();
                    $info3 = 'com_pic' . "/" . $info2;
                    $info5['pic'.$x]
                         = $info3;

                }else{
                    $info5['pic'.$x]
                        = '';
                }

            }
            $info5['com_id']=$com_id;
            $com_pic = new Com_pic();
            $cs = Com_pic::where('com_id',$com_id)->select();
            if($cs){
                $info5=array_filter($info5);
                $com_pic->update($info5);
            }else{
                $com_pic->save([
                    'com_id'  =>  $info5['com_id'],
                    'pic1' =>  $info5['pic1'],
                    'pic2' =>  $info5['pic2'],
                    'pic3' =>  $info5['pic3'],
                    'pic4' =>  $info5['pic4'],
                    'pic5' =>  $info5['pic5'],
                    'pic6' =>  $info5['pic6'],
                    'pic7' =>  $info5['pic7'],
                    'pic8' =>  $info5['pic8'],
                    'pic9' =>  $info5['pic9'],
                    'pic10' =>  $info5['pic10'],
                    'pic11' =>  $info5['pic11']
                ]);
            };



            if ($com_pic) {
                return $this->success('成功了');
            } else {
                return $this->error('失败了，请确保图片大小在500K以下，并为正规图片文件');
            }
        }
        $pics = Com_pic::where("com_id" , $com_id )->find();
        $this->assign('pics',$pics);
        return $this->fetch();
    }

    //企业资质
    public function qiyezizhi(Request $request)
    {
        $com_id = Session::get('com_id');
        $this->assign('com_id',$com_id);
        if($request->isPost())
        {
            if(request()->file('pic')){
                $info =request()->file('pic')->validate(['size'=>512000])->rule('uniqid')->move(ROOT_PATH . 'public' . "/" . 'uploads' . "/" . 'book');
                if($info==false){return $this->error('上传失败,请确保图片大小在500K以下，并为正规图片文件');}
            $info=$info->getSaveName();
            $info = 'book' . "/" . $info;
            }else{
                return $this->error('请上传图片');
            }
            $shuju = [];
            $shuju['com_id'] = $request->param('com_id');
            $shuju['book_name'] = $request->param('book_name');
            $shuju['book_palace'] = $request->param('book_palace');
            $shuju['book_time'] = $request->param('book_time');
            $shuju['pic'] = $info;
            $book = new book();
            $res=$book ->save($shuju);
            if($res)
            {
                return $this->success('上传成功');
            }else{
                return $this->error('请确保图片大小在500K以下，并为正规图片文件');
            }


        }


        return $this->fetch();
    }

    //更改企业信息
    public function tjgrxx(Request $request)
    {
        $type = ['卫生巾', '婴儿纸尿裤', '成人纸尿裤', '湿纸巾', '生活用纸', '产妇巾', '经期裤', '护理垫', '宠物垫', '乳垫'];
        $zjnum = ['1-5', '6-10', '11-15', '16-20', '20以上'];
        $znum = ['1-50', '51-100', '101-150', '151-200', '200以上'];
        $com_id = session('com_id');
        $info = Company_info::where('com_id', $com_id)->find();
        $this->assign([
            'info' => $info,
            'type' => $type,
            'zjnum' => $zjnum,
            'znum' => $znum
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
        } else {
            return 0;
        }


        return $this->fetch();

    }
    //企业资质管理
    public function qyzzgl()
    {
        $com_id = Session::get('com_id');
        $book = Book::where('com_id',$com_id)->paginate(10);
        $list = $book->render();
        $this->assign('book',$book);
        $this->assign('list',$list);
        return $this->fetch();
    }
    //企业资质删除
    public function qyzzdel(Request $request)
    {
        if ($request->isAjax())
        {
            $id = $request->get('id');
            $res = Book::where('id',$id)->find()->delete();
            if($res)
            {
                return ['code'=> 200, 'data'=> '删除成功'];
            }else{
                return ['code'=> 0, 'msg'=> '删除失败'];
            }
        }
    }
    //发邮件
    public function sendmail()
    {
        $to = "774540106@qq.com";
        $title = "修改密码";
        $msg = "http://www.bwcm.com";
        sendmail($to,$title,$msg);
        return $this->success();
    }

}
