<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


//配置文件
return [
	//网站名称
    'website'                => [
        'name'        => 'thinkphp5',
        'keywords'    => 'thinkphp5',
        'description' => 'thinkphp5'
	],
	//视图输出字符串内容替换
	'view_replace_str'       => [
        '__CSS__'    => STATIC_PATH . 'admin/css',
        '__JS__'     => STATIC_PATH . 'admin/js',
        '__IMG__'    => STATIC_PATH . 'admin/images',
		'__LIB__'    => STATIC_PATH . 'lib',
		'__PUBLIC__' => STATIC_PATH . 'public'
	],
];
