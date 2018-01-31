<?php
namespace app\admin\controller;

use think\Db;
use think\Session;
use think\Validate; 
use app\admin\model\AdminMenu;
use app\admin\controller\User;
use app\admin\model\Admin as AdminModel;
use app\admin\model\AdminLog as AdminLogModel;
use app\admin\model\AdminCate as AdminCateModel;

use app\admin\validate\User as UserValidate;

class Admin extends User{
    //管理员列表
    public function index(){
        //实例化管理员模型
        $info['cate'] = Db::name('admin_cate')->select();
        $this->assign('info',$info);

        return $this->fetch('index'); 
    }
    
    public function x(){
        $post = $this->request->post();
        dump($post['serach']);
    }

    //获取管理员列表
    public function getList(){
        if(!$this->request->isPost()){
            return $this->error('请求类型错误');
        }
        $post = $this->request->post();
        $adminModel = new AdminModel();
  
        if(array_key_exists('serach',$post) == false){
            $data = $adminModel->with('admincate')->order('create_time desc')->select()->hidden(['password','thumb','admin_cate_id','update_time'])->toArray();
        }else{
            $serach = $post['serach'];
            $where = [];
            if (isset($serach['keywords']) and !empty($serach['keywords'])){
                $where['nickname'] = ['like', '%' . $serach['keywords'] . '%'];
            }
            if (isset($serach['admin_cate_id']) and $serach['admin_cate_id'] > 0){
                $where['admin_cate_id'] = $serach['admin_cate_id'];
            }
     
            if(isset($serach['create_time']) and !empty($serach['create_time'])){
                $min_time = date("Y-m-d H:i:s",strtotime($serach['create_time']));
                $max_time = date("Y-m-d H:i:s", strtotime("next day", strtotime($serach['create_time'])));
                $where['create_time'] = [['>=',$min_time],['<=',$max_time]];
            }
            $data = $adminModel->with('admincate')->where($where)->order('create_time desc')->select()->hidden(['password','thumb','admin_cate_id','update_time'])->toArray();
        }

        return fmtData($data);
    }

    //管理员个人资料修改，属于无权限操作，仅能修改昵称和头像，后续可增加其他字段
    public function personal(){
        //获取管理员id
        $adminId = Session::get('admin');
        $adminModel = new AdminModel();
        if($adminId > 0){
            //是修改操作 
            if($this->request->isPost()){
                //是提交操作
             
                $post = $this->request->post();
                //验证昵称是否存在
                $admin = $adminModel->where(['nickname'=>$post['nickname'],'id'=>['neq',$post['id']]])->select()->toArray();
                if(!empty($admin)){
                    return $this->error('提交失败:该昵称已被占用');
                }
              
                if(false == $adminModel->allowField(true)->save($post,['id'=>$adminId])){
                    return $this->error('修改失败');
                }else{
                    addlog($adminModel->id);//写入日志
                   return $this->success('修改个人信息成功','admin/admin/personal');
                }       
            }else{
                //非提交操作
                $info['admin'] = $adminModel->where('id',$adminId)->find();
                $this->assign('info',$info);
                return $this->fetch('personal');
            }
        }else{
            return $this->error('id不正确');
        }
    }
    
    //管理员的添加及修改
    public function publish(){
        $adminModel = new AdminModel();
        //验证  唯一规则:表名,字段名,排除主键值,主键名
        $validate = new UserValidate();
        $post = $this->request->post();
    	if($this->request->has('id')){
            //是修改操作,post数据
    		if($this->request->isPost()){
                //验证部分数据合法性               
	            if(!$validate->scene('edit')->check($post)){
	                $this->error('提交失败：' . $validate->getError());
                }
                
                //验证用户名是否存在
	            $name = $adminModel->where(['name'=>$post['name'],'id'=>['neq',$post['id']]])->select()->toArray();
	            if(!empty($name)){
	            	return $this->error('提交失败：该用户名已被注册');
                }
	            //验证昵称是否存在
	            $nickname = $adminModel->where(['nickname'=>$post['nickname'],'id'=>['neq',$post['id']]])->select()->toArray();
	            if(!empty($nickname)){
	            	return $this->error('提交失败：该昵称已被占用');
	            }
	            if(false == $adminModel->allowField(true)->save($post,['id'=>$post['id']])){
	            	return $this->error('修改失败');
	            }else{
                    addlog($adminModel->id);//写入日志
	            	return $this->success('修改管理员信息成功','admin/admin/index');
	            }
    		}else{
                //修改按钮,弹出页面
                $get = $this->request->get();
    			$info['admin'] = $adminModel->where('id',$get['id'])->find();
    			$info['admin_cate'] = Db::name('admin_cate')->select();
    			$this->assign('info',$info);
    			return $this->fetch('publish');
    		}
    	}else{
    		//添加管理员,post数据
    		if($this->request->isPost()){
                //验证部分数据合法性
          	    if(!$validate->check($post)){
	                $this->error('提交失败:'.$validate->getError());
                }
	            //验证用户名是否存在
                $name = $adminModel->where('name',$post['name'])->select()->toArray();
	            if(!empty($name)){
	            	return $this->error('提交失败：该用户名已被注册');
                }          
	            //验证昵称是否存在
	            $nickname = $adminModel->where('nickname',$post['nickname'])->select()->toArray();
	            if(!empty($nickname)){
	            	return $this->error('提交失败：该昵称已被占用');
                }
                $post['password'] = password($post['password']);
	            //密码处理
	            $post['password'] = password($post['password']);
	            if(false == $adminModel->allowField(true)->save($post)){
	            	return $this->error('添加管理员失败');
	            }else{
                    addlog($adminModel->id);//写入日志
	            	return $this->success('添加管理员成功','admin/admin/index');
	            }
    		}else{
    			//添加管理员,弹出页面
    			$info['admin_cate'] = Db::name('admin_cate')->select();
    			$this->assign('info',$info);
    			return $this->fetch('publish');
    		}
    	}
    }

    //修改密码
    public function editPassword(){
        $adminModel = new AdminModel();
    	if($this->request->has('id')){
            $adminId = Session::get('admin');
            $id =$this->request->param('id'); 
    		if($id == $adminId){
    			$post = $this->request->post();
                //验证器
                $validate = new UserValidate();
	            //验证部分数据合法性
	            if(!$validate->scene('editpassowrd')->check($post)){
	                $this->error('提交失败：' . $validate->getError());
	            }
    			$admin = Db::name('admin')->where('id',$id)->find();
    			if(password($post['password_old']) == $admin['password']){
    				if(false == Db::name('admin')->where('id',$id)->update(['password'=>password($post['password'])])){
    					return $this->error('修改失败');
    				}else{
                        addlog();//写入日志
    					return $this->success('修改成功','admin/main/index');
    				}
    			}else{
    				return $this->error('原密码错误');
    			}
    		}else{
    			return $this->error('不能修改别人的密码');
    		}
    	}else{
    		return $this->fetch('editPassword');
    	}
    }

    /**
     * 管理员删除
     * @return [type] [description]
     */
    public function delete(){
        $adminModel = new AdminModel();
    	if($this->request->isPost()){
            $adminId = Session::get('admin');
            $post = $this->request->post();
            $ids = [];
            if(!is_array($post['id'])){
                $ids = array($post['id']);
            }else{
                $ids = $post['id'];
            }
    
            if(empty($ids)){
                return $this->error('没有选择删除的管理员');
            }
          
    		if(in_array(1, $ids)){
    			return $this->error('网站所有者不能被删除');
    		}
    		if(in_array($adminId, $ids)){
    			return $this->error('自己不能删除自己');
    		}
    		if(false == $adminModel->destroy($ids)){
    			return $this->error('删除失败');
    		}else{
                addlog($adminId);//写入日志
    			return $this->success('删除成功','admin/admin/index');
    		}
    	}
    }

    
    /**
     * 管理员权限分组列表
     * @return [type] [description]
     */
    public function adminCate(){
    	$model = new AdminCateModel();

        $post = $this->request->post();
        if (isset($post['keywords']) and !empty($post['keywords'])){
            $where['name'] = ['like', '%' . $post['keywords'] . '%'];
        }
 
        if(isset($post['create_time']) and !empty($post['create_time'])){
            $min_time = strtotime($post['create_time']);
            $max_time = $min_time + 24 * 60 * 60;
            $where['create_time'] = [['>=',$min_time],['<=',$max_time]];
        }
        
        $cate = empty($where) ? $model->order('create_time desc')->paginate(20) : $model->where($where)->order('create_time desc')->paginate(20);
        
    	$this->assign('cate',$cate);
    	return $this->fetch();
    }


    /**
     * 管理员角色添加和修改操作
     * @return [type] [description]
     */
    public function adminCatePublish(){
        //获取角色id
        $id = $this->request->has('id') ? $this->request->param('id', 0, 'intval') : 0;
        $model = new \app\admin\model\AdminCate();
        $menuModel = new AdminMenu();
        if($id > 0) {
            //是修改操作
            if($this->request->isPost()) {
                //是提交操作
                $post = $this->request->post();
                //验证  唯一规则： 表名，字段名，排除主键值，主键名
                $validate = new \think\Validate([
                    ['name', 'require', '角色名称不能为空'],
                ]);
                //验证部分数据合法性
                if (!$validate->check($post)) {
                    $this->error('提交失败：' . $validate->getError());
                }
                //验证用户名是否存在
                $name = $model->where(['name'=>$post['name'],'id'=>['neq',$post['id']]])->select();
                if(!empty($name)) {
                    return $this->error('提交失败：该角色名已存在');
                }
                //处理选中的权限菜单id，转为字符串
                if(!empty($post['admin_menu_id'])) {
                    $post['permissions'] = implode(',',$post['admin_menu_id']);
                } else {
                    $post['permissions'] = '0';
                }
                if(false == $model->allowField(true)->save($post,['id'=>$id])) {
                    return $this->error('修改失败');
                } else {
                    addlog($model->id);//写入日志
                    return $this->success('修改角色信息成功','admin/admin/adminCate');
                }
            } else {
                //非提交操作
                $info['cate'] = $model->where('id',$id)->find();
                if(!empty($info['cate']['permissions'])) {
                    //将菜单id字符串拆分成数组
                    $info['cate']['permissions'] = explode(',',$info['cate']['permissions']);
                }
                $menus = Db::name('admin_menu')->select();
                $info['menu'] = $this->menulist($menus);
                $this->assign('info',$info);
                return $this->fetch();
            }
        } else {
            //是新增操作
            if($this->request->isPost()) {
                //是提交操作
                $post = $this->request->post();
                //验证  唯一规则： 表名，字段名，排除主键值，主键名
                $validate = new \think\Validate([
                    ['name', 'require', '角色名称不能为空'],
                ]);
                //验证部分数据合法性
                if (!$validate->check($post)) {
                    $this->error('提交失败：' . $validate->getError());
                }
                //验证用户名是否存在
                $name = $model->where('name',$post['name'])->find();
                if(!empty($name)) {
                    return $this->error('提交失败：该角色名已存在');
                }
                //处理选中的权限菜单id，转为字符串
                if(!empty($post['admin_menu_id'])) {
                    $post['permissions'] = implode(',',$post['admin_menu_id']);
                }
                if(false == $model->allowField(true)->save($post)) {
                    return $this->error('添加角色失败');
                } else {
                    addlog($model->id);//写入日志
                    return $this->success('添加角色成功','admin/admin/adminCate');
                }
            } else {
                //非提交操作
                $menus = Db::name('admin_menu')->select();
                $info['menu'] = $this->menulist($menus);
                //$info['menu'] = $this->menulist($info['menu']);
                $this->assign('info',$info);
                return $this->fetch();
            }
        }
    }

    public function preview(){
        $id = $this->request->has('id') ? $this->request->param('id', 0, 'intval') : 0;
        $model = new \app\admin\model\AdminCate();
        $info['cate'] = $model->where('id',$id)->find();
        if(!empty($info['cate']['permissions'])) {
            //将菜单id字符串拆分成数组
            $info['cate']['permissions'] = explode(',',$info['cate']['permissions']);
        }
        $menus = Db::name('admin_menu')->select();
        $info['menu'] = $this->menulist($menus);
        $this->assign('info',$info);
        return $this->fetch();
    }

    protected function menulist($menu,$id=0,$level=0){
        static $menus = array();
        $size = count($menus)-1;
        foreach ($menu as $value) {
            if ($value['pid']==$id) {
                $value['level'] = $level+1;
                if($level == 0)
                {
                    $value['str'] = str_repeat('',$value['level']);
                    $menus[] = $value;
                }
                elseif($level == 2)
                {
                    $value['str'] = '&emsp;&emsp;&emsp;&emsp;'.'└ ';
                    $menus[$size]['list'][] = $value;
                }
                else
                {
                    $value['str'] = '&emsp;&emsp;'.'└ ';
                    $menus[$size]['list'][] = $value;
                }
                
                $this->menulist($menu,$value['id'],$value['level']);
            }
        }
        return $menus;
    }

    /**
     * 管理员角色删除
     * @return [type] [description]
     */
    public function adminCateDelete(){
        if($this->request->isAjax()) {
            $id = $this->request->has('id') ? $this->request->param('id', 0, 'intval') : 0;
            if($id > 0) {
                if($id == 1) {
                    return $this->error('超级管理员角色不能删除');
                }
                if(false == Db::name('admin_cate')->where('id',$id)->delete()) {
                    return $this->error('删除失败');
                } else {
                    addlog($id);//写入日志
                    return $this->success('删除成功','admin/admin/adminCate');
                }
            } else {
                return $this->error('id不正确');
            }
        }
    }

    public function log(){
        $model = new AdminLogModel();

        $post = $this->request->post();
        if (isset($post['admin_menu_id']) and $post['admin_menu_id'] > 0) {
            $where['admin_menu_id'] = $post['admin_menu_id'];
        }
        
        if (isset($post['admin_id']) and $post['admin_id'] > 0) {
            $where['admin_id'] = $post['admin_id'];
        }
 
        if(isset($post['create_time']) and !empty($post['create_time'])) {
            $min_time = strtotime($post['create_time']);
            $max_time = $min_time + 24 * 60 * 60;
            $where['create_time'] = [['>=',$min_time],['<=',$max_time]];
        }
        
        $log = empty($where) ? $model->order('create_time desc')->paginate(20) : $model->where($where)->order('create_time desc')->paginate(20);
        
        $this->assign('log',$log);
        //身份列表
        $admin_cate = Db::name('admin_cate')->select();
        $this->assign('admin_cate',$admin_cate);
        $info['menu'] = Db::name('admin_menu')->select();
        $info['admin'] = Db::name('admin')->select();
        $this->assign('info',$info);
        return $this->fetch();
    }
}
