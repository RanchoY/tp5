<?php
namespace app\admin\model;

use \think\Model;
class Attachment extends Model{
    protected $updateTime = false;
    protected $resultSetType = 'collection';
    protected $autoWriteTimestamp = 'timestamp';
    
    public function admin(){
        //关联管理员表
        return $this->belongsTo('Admin')->bind(['admin_nickname'=>'nickname']);
    }

    // public function getStatusAttr($value){
    //     $status = [-1=>'未通过',0=>'待审核',1=>'已审核'];
    //     return $status[$value];
    // }

    public function getFilesizeAttr($value){
        return round($value/1024,2).'KB';
    }
}
