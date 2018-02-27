<?php
namespace app\commons\controller;
use think\Controller;
use app\commons\msg\Message;

class Msg extends Controller
{

public function index(){
  	 return $this->fetch();
}
//发送短信
public function sendMsg(){
     $tel=input('tel');
     $verify=input('verify');
    return Message::sendMsg($tel,$verify);
}  
//手机验证
public function telcheck(){
        if(Message::telcheck(input('code'))){
           $this->success('验证成功');
        }else{
          $this->error('验证失败');
        }
  }
//短信通知信息
  public function sendMsg_p(){ 
    if(Message::sendMsg_p(input('tel'),input('code'))){
    	$this->success('请求成功');
     }  
  }

}