<?php 
namespace app\commons\controller;
use app\commons\weixin\Weixin;
use app\commons\weixin\Jssdk;
use app\commons\pay\Pay;
use think\Cookie;
use think\Controller;
use think\Request;

class Weixins extends Controller{
    //授权获得个人微信信息，并COOKIE
    public function one(){
        $person=session('person');
        if(empty($person)){Weixin::person();exit;}
        dump($person); 
    }
    public function oness(){ //清除session
        session('person', null);
    }

    //静默获取个人openid，并COOKIE
    public function two(){
        $openid=cookie('openid');
        if(empty($openid)){ 
            Weixin::openid();exit;
        }
         dump($openid);
    }
    public function twoss(){  //清除cookie
        cookie('openid', null);
    }


    //发送模板消息
    public function msg(){
        $openid=cookie('openid');
        if(empty($openid)){
            Weixin::openid();exit;
        }

        $template_id='0weOdi7Yo-BL4Cyo7GYic-xq2VVkRrNusae3BltWf7s';
        $fromUsername=$openid;
        $title='111';
        $last="222";
        $url='http://www.baidu.com';
        $value=array('333','444','555','666');
        Weixin::mb($template_id,$fromUsername,$title,$last,$url,$value); 
    }

    //获取参数二维码
    public function ewm(){
        dump(Weixin::p_code('001'));//001为参数
    }       


    //页面分享
    public function share(){
        $jssdk = new Jssdk();
        $signPackage = $jssdk->GetSignPackage();
        $this->assign('signPackage',$signPackage);
        return $this->fetch();
    } 
    //发红包
    public function hb(){
        $openid=cookie('openid');
        if(empty($openid)){
            Weixin::openid();exit;
        }
        $money=1;
        Pay::hbao($openid,$money);     
    } 
}