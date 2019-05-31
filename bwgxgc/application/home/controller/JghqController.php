<?php

namespace app\home\controller;

use app\home\model\BannerItem;
use app\home\model\Categorya;
use app\home\model\Categoryb;
use app\home\model\Hotmarket;
use think\Controller;
use think\Env;
use think\Request;
use think\Session;

class JghqController extends Controller
{
    public function jghq(){
        $banneritem = BannerItem::getBannerItem();
        $categoryas =Categorya::getCategorya();
        $categorybs =Categoryb::getCategoryb();
//        $hotmarket =Hotmarket::getHotMarket();
        $hotspot=Hotmarket::getHotSpot();
        //每次进页面获取bzflag，如为空，则清空分类session
        $bzflag = Request::instance()->param('bzflag') ? Request::instance()->param('bzflag') : null;
        $cbflag = Request::instance()->param('cbflag') ? Request::instance()->param('cbflag') : Session('cbflag') ;
        Session::set('cbflag',$cbflag);
        if(empty($bzflag)){
            session('bzflag',-2);
            $hotmarket =Hotmarket::getHotMarket();
        }
        //一级分类全部查询
        if($bzflag==-2){
            session('cbflag',null);
            $hotmarket = Hotmarket::order('hmid desc')->paginate(20);
        }
        //二级分类全部查询
        if($bzflag==-1){
            if (!empty($cbflag)){
                $cbflag = Session('cbflag');
                $hotmarket = Hotmarket::where('ca_id','=',$cbflag)->order('hmid desc')->paginate(20);
            }
        }
        //二级分类具体查询
        if($bzflag==0){
            if(!empty($cbflag)){
                $cbflag = Session('cbflag');
                $hotmarket = Hotmarket::where('cb_id','=',$cbflag)->order('hmid desc')->paginate(20);
            }
        }
        //获得分页的页码列表信息 并传递给模板
        $pagelist = $hotmarket->render();
//        $this->assign('pagelist',$pagelist);
//        $this->assign('hotmarket',$hotmarket);
        $this->assign([
            'banneritem' => $banneritem,
            'categorygas' => $categoryas,
            'categorygbs' => $categorybs,
            'hotmarket'=> $hotmarket,
            'hotspot' => $hotspot,
            'pagelist' => $pagelist
        ]);
        return $this->fetch();
    }

    public function categoryBZ(Request $request){
        $bzflag = Request::instance()->param() ? $request->param('bzflag') : null;
        if(empty($bzflag)){
            session('Zid',null);
            session('Dname',null);
        }
    }
    //找寻对地址栏加密的方法
    //
    public function sendCategorysID(){
        $cate = Categorya::find('caid');
        $this->assign('cate',$cate);
        return $this->fetch();
    }

    public function jghqdetails($pqid){
        $banhm = Hotmarket::getBannerID($pqid);
        $news = Hotmarket::getNewsID($pqid);
        $banhs = Hotmarket::getHotSpotID($pqid);

        $this->assign([
            'pdid' => $banhm,
            'pdid' => $news,
            'pdid' => $banhs,
        ]);
        return $this->fetch();
    }


}