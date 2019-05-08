<?php

namespace app\admin\controller;

use app\admin\model\Video;
use think\Controller;
use think\Request;
use think\Session;

class VideoController extends Controller
{
    public function videoup(Request $request)
    {
        $com_id = session('com_id');
        $info = Video::where('com_id', $com_id)->select();

        $this->assign([
            'info' => $info,
            'com_id'=>$com_id
        ]);

        if($request->isPost()) {
            $shuju = [];
            $id = $request->param('hname');
            $shuju['com_id'] = $request->param('com_id');
            $shuju['vname'] = $request->param('vname');
            $shuju['vurl'] = $request->param('vurl');


            $video = new video();
            if($id!='')
            {
                $res=Video::where('id',$id)->update($shuju);
            }else{
                $res=$video->save($shuju);
            }

            if ($res) {
                return $this->success('成功了');
            } else {
                return   $this->error('失败了');
            }
        }

        return $this->fetch();
    }
}