<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2018/8/13
 * Time: 9:09
 */
return [
    // 生成应用公共文件
    '__file__' => ['common.php', 'config.php', 'database.php'],

    // 定义demo模块的自动生成 （按照实际定义的文件名生成）
    'home'     => [
        '__file__'   => ['common.php'],
        '__dir__'    => ['behavior', 'controller', 'model', 'view'],
        'controller' => ['IndexController', 'UserController', 'GoodsController'],
        'model'      => ['User', 'UserType'],
        'view'       => ['index/index'],
    ],
    'admin'     => [
        '__file__'   => ['common.php'],
        '__dir__'    => ['behavior', 'controller', 'model', 'view'],
        'controller' => ['IndexController','GoodsController'],
        'model'      => ['User', 'UserType'],
        'view'       => ['index/index'],
    ],
];