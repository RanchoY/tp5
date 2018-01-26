<?php
namespace app\admin\model;

use think\Model;
class Article extends Model{
    protected $autoWriteTimestamp = 'timestamp';
    
	public function cate(){
        //关联分类表
        return $this->belongsTo('ArticleCate');
    }

    public function admin(){
        //关联角色表
        return $this->belongsTo('Admin');
    }
}
