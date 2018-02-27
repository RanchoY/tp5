<?php
namespace app\admin\model;

use think\Model;

class AdminCate extends Model{
    protected $resultSetType = 'collection';
    protected $autoWriteTimestamp = 'timestamp';

	public function admin(){
        //关联管理员表
        return $this->hasOne('Admin');
    }
}
