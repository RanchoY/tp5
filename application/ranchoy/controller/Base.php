<?php
namespace app\ranchoy\controller;

use think\Controller;
use app\ranchoy\controller\ReturnCode;

class Base extends Controller{
    //返回错误码
    static public function showReturnCode($code='', $data=[], $msg=''){
        $result = [
            'code' => empty($code) ? '500' : $code,
            'msg' => '未定义消息',
            'data' => is_array($data) ? $data : '',
        ];
        if(!is_array($data) && empty($msg)){
            $result['msg'] = $data;
        }else{
            if(!empty($code)){

                if(!empty($msg)){
                    $result['msg'] = $msg;
                }else if(isset(ReturnCode::$return_code[$code])){
                    $result['msg'] = ReturnCode::$return_code[$code];
                }
            }
        }
        return $result;
    }

    static public function showReturnCodeWithOutData($code='', $msg=''){
        return self::showReturnCode($code,[],$msg);
    }

    /**
     * 数据库字段 网页字段转换
     * 标识为数据库字段 值为浏览器提交字段
     * @param $array   标识为数据库字段 值为浏览器提交字段
     * @param bool|false $uuid  是否追加UUID信息
     * @return array
     */
    protected function buildParam($array){
        $data=[];
        foreach( $array as $item=>$value ){
            $data[$item] = $this->request->param($value);
        }
        return $data;
    }

}