<?php
namespace app\commons\pay;
use think\Controller;
class Pay extends Controller{
static function hbaos(){
 return $res=rand(0,1);
}
static function hbao($openid,$total_amount){
        $name='奖励红包';//红包名称
        $wishing='恭喜你完善好信息赢得一枚红包';//打开红包显示
        $client_ip='121.41.51.204';//当前IP，红包后台添加白名单
        $mch_id='1485720562';//商户号
        $appid='wxed9ebcf5a068efbe';//APPID
        $key="ASr89JyQYS9jGOhCHl8YOs99lcgYWzRk";//支付密钥
        $order='1485720562'.date('YmdHis',time()).rand(1000,2000);//订单号，不允许重复
        //scene_id=PRODUCT_2  场景值默认 抽奖

        $total_amount=$total_amount*100;
	$risk_info=urlencode("posttime=".time()."&clientversion=xxx&mobile=xxx&deviceid=xxx");
	$nonce_str='ibuaiVcKdpRxkhJA';
	$str="act_name=系统发放&client_ip=".$client_ip."&mch_billno=".$order."&mch_id=".$mch_id."&nonce_str=".$nonce_str."&re_openid=".$openid."&remark=备注&risk_info=".$risk_info."&scene_id=PRODUCT_2&send_name=".$name."&total_amount=".$total_amount."&total_num=1&wishing=".$wishing."&wxappid=".$appid."&key=".$key;
	$sign=md5($str);
	$sign=strtoupper($sign);

	$datas="<xml>
		<act_name><![CDATA[系统发放]]></act_name>
		<client_ip>".$client_ip."</client_ip>
		<mch_billno><![CDATA[".$order."]]></mch_billno>
		<mch_id>".$mch_id."</mch_id>
		<nonce_str><![CDATA[".$nonce_str."]]></nonce_str>
		<re_openid><![CDATA[".$openid."]]></re_openid>
		<remark>备注</remark>
		<risk_info><![CDATA[".$risk_info."]]></risk_info>
		<scene_id>PRODUCT_2</scene_id>
		<send_name><![CDATA[".$name."]]></send_name>
		<total_amount><![CDATA[".$total_amount."]]></total_amount>
		<total_num>1</total_num>
		<wishing><![CDATA[".$wishing."]]></wishing>
		<wxappid>".$appid."</wxappid>
		<sign><![CDATA[".$sign."]]></sign>
	</xml>";

	$data =self::curl_post_ssl('https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack', $datas);

	$postObj = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
	$res['state'] = trim($postObj->result_code);
	//$res['order'] = trim($postObj->mch_billno);
	return $res['state'];
}

static function curl_post_ssl($url, $vars, $second=30,$aHeader=array())
{
	$ch = curl_init();
	//超时时间
	curl_setopt($ch,CURLOPT_TIMEOUT,$second);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
	//这里设置代理，如果有的话
	//curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
	//curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	
	//以下两种方式需选择一种
	
	//第一种方法，cert 与 key 分别属于两个.pem文件
	//默认格式为PEM，可以注释
	//curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
	//curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/cert.pem');
	//默认格式为PEM，可以注释
	//curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
	//curl_setopt($ch,CURLOPT_SSLKEY,getcwd().'/private.pem');
	
	//第二种方式，两个文件合成一个.pem文件
       //$data = $this->get_php_file(substr(__FILE__,0,-9)."all.pem");
	curl_setopt($ch,CURLOPT_SSLCERT,getcwd()."/application/commons/pay/all.pem");
 
	if( count($aHeader) >= 1 ){
		curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
	}
 
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
	$data = curl_exec($ch);
	if($data){
		curl_close($ch);
		return $data;
	}
	else { 
		$error = curl_errno($ch);
		echo "call faild, errorCode:$error\n"; 
		curl_close($ch);
		return false;
	}
}

}