<?php
namespace app\home\controller;

use app\home\model\Card;
use app\home\model\Com_pic;
use app\home\model\Customgood;
use app\home\model\User_person;
use app\home\model\Type;
use think\Controller;
use app\home\model\Area;
use app\home\model\Company_info;
use think\Request;
use think\Session;
class IndexController extends Controller
{
    //前台首页
    public function index()
    {
        $com = Company_info::where('role_id',30)->order('com_id', 'desc')->limit(8)->select();
        for($x=0;$x<count($com);$x++)
        {

            $pics = Com_pic::where('com_id',$com[$x]['com_id'])->find();
            $com[$x]['pic6'] =$pics['pic6'];
            $com[$x]['pic5'] =$pics['pic5'];
            $com[$x]['pic9'] =$pics['pic9'];
            $com[$x]['pic8'] =$pics['pic8'];
        }
        $card = Card::where('id','>','1')->order('id', 'asc')->limit(6)->select();
        $card2 = Card::where('id','>','1')->order('id', 'desc')->limit(6)->select();
        $info = Company_info::where('com_id',16)->find();
        $pic = Com_pic::where('com_id',16)->column('pic6');
        $this->assign([
            'com'=>$com,
            'card'=>$card,
            'card2'=>$card2,
            'info'=>$info,
            'pic'=>$pic
            ]);

        $customgood = new customgood();
        $data = $customgood->select();
        $this->assign('data',$data);






        return $this->fetch();
    }
    
    //前台页脚
    public function foot_base()
    {
        return $this->fetch();
    }

    //网络批发
    public function wlpf()
    {
        return $this->fetch();
    }

    //杂志
    public function magazine()
    {
        return $this->fetch();
    }

    //收藏夹
    public function shoucangjia(Request $request)
    {
        $user_id = Session('user_id');
        $user = User_person::where('user_id',$user_id)->find();

        $data = implode(',',$user['cus_fav']);
        $this->assign('data',$data);

        return $this->fetch();
    }


    //贴牌搜索
    public function tpsousuo(Request $request)
    {
        if($request->isGet())
        {
            $kwds = $request->get('keywords');
            Session::set('key',$kwds);
            $ks=Session::get('key');
           if($kwds){
               if($card = Card::where('type','like','%'.$ks.'%')
                   ->whereOr('carname','like','%'.$ks.'%')
                   ->whereOr('company_name','like','%'.$ks.'%')
                   ->select())
               {
                   $this->assign([ 'card'=>$card,
                                    'ks'=>$ks
                           ]

                   );
               }else{
                   return $this->redirect('{:url(\'home/index/gcsousuo\',[\'keywords\'=>$ks])}');
               }


           }else{
               return $this->error('请输入查询条件');
           }


        }

        return $this->fetch();

    }
    //定制搜索
    public function dzsousuo(Request $request)
    {
        if($request->isGet())
        {
            $kwds = $request->get('keywords');
            Session::set('key',$kwds);
            $ks=Session::get('key');
            if( $custom = Customgood::where('cus_proname','like','%'.$ks.'%')->select()){
                $this->assign(
                    [
                        'custom'=>$custom,'ks'=>$ks]);
            }else{
                return $this->redirect('{:url(\'home/index/gcsousuo\',[\'keywords\'=>$ks])}');
            }

        }

        return $this->fetch();

    }
    //工厂搜索
    public function gcsousuo(Request $request)
    {
        if($request->isGet())
        {
            $kwds = $request->get('keywords');
            Session::set('key',$kwds);
            $ks=Session::get('key');

            if(
                $com = Company_info::where('company_name','like','%'.$ks.'%')
                ->whereOr('address','like','%'.$ks.'%')
                ->select()
            )
            {

                for($x=0;$x<count($com);$x++)
                {

                    $pics = Com_pic::where('com_id',$com[$x]['com_id'])->find();
                    $com[$x]['pic6'] =$pics['pic6'];
                    $com[$x]['pic5'] =$pics['pic5'];
                    $com[$x]['pic9'] =$pics['pic9'];
                    $com[$x]['pic8'] =$pics['pic8'];
                }
                $this->assign(['com'=>$com,

                        'ks'=>$ks
                    ]
                );

            }else{
                return $this->error('暂无相关数据');
        }






        }

        return $this->fetch();

    }
}