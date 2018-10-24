<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

use app\admin\model\Type;
use app\admin\model\Category;
use app\home\model\Attribute;


// 应用公共文件

/**
 * 获得全部可供选取的类型信息
 */
function get_type_info(){
    return Type::select();
}

/***********递归方式获取上下级权限信息****************/
function generateTree($data){
    $items = array();
    foreach($data as $v){
        $items[$v['ps_id']] = $v;
    }
    $tree = array();
    foreach($items as $k => $item){
        if(isset($items[$item['ps_pid']])){
            $items[$item['ps_pid']]['son'][] = &$items[$k];
        }else{
            $tree[] = &$items[$k];
        }
    }
    return getTreeData($tree);
}
function getTreeData($tree,$level=0){
    static $arr = array();
    foreach($tree as $t){
        $tmp = $t;
        unset($tmp['son']);
        //$tmp['level'] = $level;
        $arr[] = $tmp;
        if(isset($t['son'])){
            getTreeData($t['son'],$level+1);
        }
    }
    return $arr;
}