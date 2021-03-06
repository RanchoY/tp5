<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
//定义静态资源目录或url
define('STATIC_PATH', '/tplay/public/static/');
//定义PUBLIC目录
define('PUBLIC_PATH', '/tplay/public/index.php/');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
// 自动生成模块
//\think\Build::module('index');