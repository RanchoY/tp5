<?php
namespace app\commons\msg;
use think\Controller;
use think\Session;
use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;

import('autoload', EXTEND_PATH.'/dysms/vendor/');
class Message
{
    static  function sendMsg($mobile,$yanzheng){
        if($yanzheng==''){
          return 0;exit;
        }
        $captcha = new \think\captcha\Captcha();
        if (!$captcha->check($yanzheng)) {
           return 0;exit;
        }
        $code=rand(1000,9999);
        Session::set('code',$code);
        $c=(string)$code;
        $code=$c;

        Config::load();             //加载区域结点配置
        $accessKeyId = config('dysms.accessKeyId');
        $accessKeySecret = config('dysms.accessKeySecret');
        $templateParam = array("code"=>$code);           //模板变量替换
        $signName = config('dysms.signName') ;
        $templateCode = config('dysms.codetemplate');   //短信模板ID
        //短信API产品名（短信产品名固定，无需修改）
        $product = "Dysmsapi";
        //短信API产品域名（接口地址固定，无需修改）
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）
        $region = "cn-hangzhou";

        //初始化用户Profile实例
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        //增加服务结点
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        //初始化AcsClient用于发起请求
        $acsClient= new DefaultAcsClient($profile);

        //初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();
        //必填,设置雉短信接收号码
        $request->setPhoneNumbers($mobile);

        //必填,设置签名名称
        $request->setSignName($signName);

        //必填,设置模板CODE
        $request->setTemplateCode($templateCode);

        //可选,设置模板参数
        if($templateParam) {
            $request->setTemplateParam(json_encode($templateParam));
        }

        //发起访问请求
        $acsResponse = $acsClient->getAcsResponse($request);

        $result = json_decode(json_encode($acsResponse),true);
        //return $result;exit;
        if($result['Code']=='OK'){
            return 1;
         }else{
            return $result;
         }
    }

    //手机验证
    static function telcheck($code){
        if($code!=null && $code==Session::get('code')){
           return true;
        }else{
           return false;
        }
    }


    static function sendMsg_p($tel,$msg){
        if(empty($tel)){
            return false;exit;
        }
        $mobile=$tel;
        $code=$msg;

        Config::load();             //加载区域结点配置

        $accessKeyId = config('dysms.accessKeyId');
        $accessKeySecret = config('dysms.accessKeySecret');
        $templateParam = array("code"=>$code);           //模板变量替换
        $signName = config('dysms.signName') ;
        $templateCode = config('dysms.msgtemplate');   //短信模板ID

        //短信API产品名（短信产品名固定，无需修改）
        $product = "Dysmsapi";
        //短信API产品域名（接口地址固定，无需修改）
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）
        $region = "cn-hangzhou";

        // 初始化用户Profile实例
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        // 增加服务结点
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        // 初始化AcsClient用于发起请求
        $acsClient= new DefaultAcsClient($profile);

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();
        // 必填，设置雉短信接收号码
        $request->setPhoneNumbers($mobile);

        // 必填，设置签名名称
        $request->setSignName($signName);

        // 必填，设置模板CODE
        $request->setTemplateCode($templateCode);

        // 可选，设置模板参数
        if($templateParam) {
            $request->setTemplateParam(json_encode($templateParam));
        }

        //发起访问请求
        $acsResponse = $acsClient->getAcsResponse($request);

        //返回请求结果
        $result = json_decode(json_encode($acsResponse),true);
        //return $result;exit;
        if($result['Code']=='OK'){
            return true;
         }else{
            return false;
         }
    }

}