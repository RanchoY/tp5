<?php
namespace app\admin\model;

use think\Model;

class Admin extends Model{
    protected $resultSetType = 'collection';
    protected $autoWriteTimestamp = 'timestamp';
    
	public function admincate(){
        //关联角色表,bind把子模型属性绑定属性到父模型
        return $this->belongsTo('AdminCate','admin_cate_id','id')->bind(['admin_cate_name'=>'name']);
    }

    public function article(){
        //关联文章表
        return $this->hasOne('Article');
    }

    public function log(){
        //关联日志表
        return $this->hasOne('AdminLog');
    }

    public function attachment(){
        //关联附件表
        return $this->hasOne('Attachment');
    }
}
