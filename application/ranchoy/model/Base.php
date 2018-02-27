<?php 
namespace app\ranchoy\model;

use think\Model;

class Base extends Model{

	protected $autoWriteTimestamp = 'datetime';
	protected $updateTime = false;

	public function add($data){
		if(array_key_exists('password',$data)){
			$data['password'] = md5($data['password']);
		}
		$res = $this->allowField(true)->save($data);
		if($res){
			$info = success('添加成功',1);
		}else{
			$info = error('添加失败',2);
		}
		return $info;
	}

	public function edit($data){
		$flag = $this->where('id',$data['id'])->update($data);
		if($flag){
			$info = success('修改成功',1);
		}else{
			$info = error('修改失败',2);
		}
		return $info;
	}

	public function del($data){
		$flag = $this->where('id',$data['id'])->delete();
		if($flag){
			$info = success('删除成功',1);
		}else{
			$info = error('删除失败',2);
		}
		return $info;
	}
}
