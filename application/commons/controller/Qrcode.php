<?php 
namespace app\commons\controller;
use app\commons\qrcode\Phpqrcode;
use think\Controller;
use think\Request;
class Qrcode extends Controller
{
public function index(){
   echo '<a href="">生成二维码</a><form action="'.url('getqrcode').'" method="get" ><input type="text" name="content"><input type="submit" value="提交"></form><hr>';
}
public function getqrcode(Request $request){
    $qrcode = new PHPqrcode;
    $content = $file = $request->get('content');
    $path = $qrcode->getqrcode($content);
    echo '<img src ="/tpcore/'.$path.' "/><a target="_blank" href='."'".url('download').'?filename=.'.$path."'".'>点击下载</a>';
  }

public function download(Request $request){
        //下载
        $filename = $request->get('filename');
        $filename = trim($filename,'.');
        $file = fopen('.'.$filename,'r');
        header('Content-Type:application/octet-stream;');//声明下载文件格式
        header('Accept-Ranges:bytes;');
        header('Accept-Length:'.filesize('.'.$filename));//下载文件大小
        header('Content-Disposition:attachment;filename=qrcode.png');//声明下载文件方式与下载文件位置

        echo fread($file,filesize('.'.$filename));

        fclose($file);
        exit;
}
 
}