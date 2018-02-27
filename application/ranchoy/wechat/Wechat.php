<?php
namespace app\common\wechat;

use think\Db;
use think\Controller;

class Wechat extends Controller{
    
    protected static $appid = 'appid';

    public function __construct($appid){
       self::$appid = $appid;
    }

    //发送模板消息
    public function mb($template_id,$fromUsername,$title,$last,$url,$value){
        $access_token=$this->get_access();
        $post_url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token;
        $arr=array();
        $arr['touser']=$fromUsername;
        $arr['template_id']=$template_id;
        $arr['url']=$url;
        $arr['data']['first']['value']=$title;
        $arr['data']['first']['color']="#173177";
        foreach($value as $key=>$val){
            $keyword='keyword'.($key+1);
            $arr['data'][$keyword]['value']=$val;
            $arr['data'][$keyword]['color']="#173177";
        }
        $arr['data']['remark']['value']=$last;
        $arr['data']['remark']['color']="#173177";

        $data=json_encode($arr);
        $this->post2($post_url,$data);
    }

    //群发送模板消息
    public function mb_all($template_id,$title,$last,$url,$value){
        $access_token=$this->get_access();
        $post_url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token;
        $arr=array();
        $arr['template_id']=$template_id;
        $arr['url']=$url;
        $arr['data']['first']['value']=$title;
        $arr['data']['first']['color']="#173177";
        foreach($value as $key=>$val){
        $keyword='keyword'.($key+1);
        $arr['data'][$keyword]['value']=$val;
        $arr['data'][$keyword]['color']="#173177";
        }
        $arr['data']['remark']['value']=$last;
        $arr['data']['remark']['color']="#173177";

        $url="https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$access_token."&next_openid=";
        $all_openid=$this->get($url);
        foreach($all_openid['data']['openid'] as $key => $openid){
            $arr['touser']=$openid;
        $data=json_encode($arr);
        $this->post2($post_url,$data);
        }
    }

    //获取参数二维码,场景值为字符串类型,长度限制为1到64
    public function p_code_str($str){
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->get_access();
        $arr=json_encode(array('action_name'=>'QR_LIMIT_STR_SCENE','action_info'=>array('scene'=>array('scene_str'=>$str))));
        $result=json_decode($this->post2($url,$arr));
        return $result->ticket;
    }
    
    //获得全局access_token
    public function get_access(){
        //查询access_token
        $data = Db::name('wechat')->where('appid',self::$appid)->find();
        if($data['expire_time'] < time()){
            $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=". $data['appid'] ."&secret=". $data['appsecret'];
            $arr=$this->get($url);
            $access_token = $arr['access_token'];
            if($access_token){
                $data['expire_time'] = time() + 7000;
                $data['access_token'] = $access_token;
                Db::name('wechat')->update($data);
            }
        }else{
            $access_token = $data['access_token'];
        }
        return $access_token;
    }

    //post方法
    public function post2($url, $data){
        $opts = array('http' => array('method'=>'POST', 'header'=>'Content-type:application/x-www-form-urlencoded', 'content'=>$data));
        $context = stream_context_create($opts);

        return $result = file_get_contents($url, false, $context);
    }

    //get方法
    public function get($url){
        $ch = curl_init();
        curl_setopt($ch , CURLOPT_URL, $url);
        curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close( $ch );
        $arr = json_decode($res, true);

        return($arr);
    }

    public function get_php_file($filename) {
        return trim(substr(file_get_contents($filename), 15));
    }

    public function set_php_file($filename, $content) {
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>".$content);
        fclose($fp);
    }
}