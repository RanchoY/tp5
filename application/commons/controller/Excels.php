<?php 
namespace app\commons\controller;
use app\commons\excel\Excel;
use think\Controller;
use think\Request;
class Excels extends Controller
{
public function index(){
  echo '<a href="'.url('excel').'">导出数据</a><br><hr>';
  echo '<a href="">导入数据</a><form action="'.url('inexcel').'" method="post" enctype="multipart/form-data"><input type="file" name="excel"><input type="submit" value="提交"></form><hr>';
}
//导出
public function excel(){
        $name ='登记表';
        $header = array('1','2','3','4','5','6');
        $data = [
            ['a',' ','c','c','b','d'],
            ['b','a','a','d','b','d'],
            ['c','a','d','c','b','d'],
            ['a','b','b','d','b','d'],
        ];
        $result = Excel::writer($header,$data,$name);
}
    
//导入
    public function inexcel(Request $request){
        $file = $request->file('excel');
        $info = $file->move(ROOT_PATH.'UploadFiles/');
        if($info){
            $savename = $info->getSaveName();

            $arr=Excel::reader(ROOT_PATH.'UploadFiles/'.$savename);
            dump($arr);
               //  $data=array();
               //  $data['isbao']=1;
               //  $data['time']=date('y-m-d',time());
               //  $i=0;
               // foreach ($arr  as  $value) {
               //  if($i>0){
               //    $data['name']=$value['A'];
               //    Db::name('zhao')->insert($data);
               //   }
               //   $i++;
               //  }
               // $this->success('发布成功');
        }else{
            echo $file->getError();
        }
    }

 
}