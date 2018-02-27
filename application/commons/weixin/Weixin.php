<?php
namespace app\commons\weixin;
use think\Cookie;
use think\Request;
use think\Controller;
class Weixin extends Controller
{
    //授权获得个人微信信息，并COOKIE
    static function person(){

        $data=input('code');
        $request=request();
        $url=$request->domain().$request->url();

        if(!empty($data)){
            $url1 ="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".config('weixin.appid')."&secret=".config('weixin.appsecret')."&code=".$data."&grant_type=authorization_code";
            $a=self::get($url1);
            if(empty($a['access_token'])){
                echo "<script>window.location.href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=".config('weixin.appid')."&redirect_uri=".urlencode($url)."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect'</script>";
                exit;
            }
            $url2="https://api.weixin.qq.com/sns/userinfo?access_token=".$a['access_token']."&openid=".$a['openid']."&lang=zh_CN";
            $arr=self::get($url2);
            Cookie::set('openid',$arr['openid'],360000);  //COOKIE保存openid一个周
            session('person',$arr);  //以session形式返回用户信息

            echo "<script>window.location.href='".$url."'</script>";
        }else{
            echo "<script>window.location.href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=".config('weixin.appid')."&redirect_uri=".urlencode($url)."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect'</script>";
        }
    }

    //静默获取个人openid，并COOKIE
    static function openid(){
        $data=input('code');
        $request=new Request;
        $url=$request->domain().$request->url();
        if(!empty($data)){
            $url1="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".config('weixin.appid')."&secret=".config('weixin.appsecret')."&code=".$data."&grant_type=authorization_code";
            $a=self::get($url1);
            Cookie::set('openid',$a['openid'],360000);  //COOKIE保存openid一个周

            echo "<script>window.location.href='".$url."'</script>";
        }else{
            echo "<script>window.location.href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=".config('weixin.appid')."&redirect_uri=".urlencode($url)."&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect'</script>";
        }
    }

    //发送模板消息
    static function mb($template_id,$fromUsername,$title,$last,$url,$value){
        $access_token=self::get_access();
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
        self::post2($post_url,$data);
    }

    //群发送模板消息
    static function mb_all($template_id,$title,$last,$url,$value){
        $access_token=self::get_access();
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
        $all_openid=self::get($url);
        foreach($all_openid['data']['openid'] as $key => $openid){
            $arr['touser']=$openid;
        $data=json_encode($arr);
        self::post2($post_url,$data);
        }
    }
    //获取参数二维码
    static function p_code($id){
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.self::get_access();
        $arr=json_encode(array('action_name'=>'QR_LIMIT_SCENE','action_info'=>array('scene'=>array('scene_id'=>$id))));
        $result=self::post2($url,$arr);
        $re=json_decode($result);
        return $re->ticket;
    }

    //获得全局access_token
    static function get_access(){
        $data = json_decode(self::get_php_file( substr(__FILE__,0,-10)."access_token.php"));

        if($data->expire_time < time()){
            $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".config('weixin.appid')."&secret=".config('weixin.appsecret');
            $arr=self::get($url);
            $access_token=$arr['access_token'];
            if($access_token){
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                self::set_php_file(substr(__FILE__,0,-10)."access_token.php", json_encode($data));
            }
        }else{
          $access_token = $data->access_token;
        }
        return $access_token;
    }

    //post方法
    static function post2($url, $data){
        $opts = array('http' => array('method'=>'POST', 'header'=>'Content-type:application/x-www-form-urlencoded', 'content'=>$data));
        $context = stream_context_create($opts);

        return $result = file_get_contents($url, false, $context);
    }
    //get方法
    static function get($url){
        $ch = curl_init();
        curl_setopt($ch , CURLOPT_URL, $url);
        curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close( $ch );
        $arr = json_decode($res, true);

        return($arr);
    }

    static function get_php_file($filename) {
        return trim(substr(file_get_contents($filename), 15));
    }

    static function set_php_file($filename, $content) {
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>".$content);
        fclose($fp);
    }
}