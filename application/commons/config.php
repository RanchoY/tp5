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

return [
    //短信配置
    'dysms'=>[
        'accessKeyId'=>'LTAIcPxoZz7amuhK',
        'accessKeySecret'=>'phoNWqm1zNXtRibk2PUA3ygcSfZh8w',
        'codetemplate'=>'SMS_80040061',  //验证码模板
        'msgtemplate'=>'SMS_80040061',   //短信消息推送模板
        'signName'=>'律见',
    ],
    //微信配置
    'weixin'=>[
        'appid'=>'wxf07bc7c6ac009998',
        'appsecret'=>'3808a7ee3778c0472004212c774fd366',
    ],
];
