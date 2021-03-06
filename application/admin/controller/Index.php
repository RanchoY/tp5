<?php
namespace app\admin\controller;

use think\Db;
use think\Cookie;
use app\admin\controller\User;

class Index extends User{
    public function index(){
        $menu = Db::name('admin_menu')->where(['is_display'=>1])->order('orders asc')->select();
        //添加url
        foreach ($menu as $key => $value) {
        	if(empty($value['parameter'])) {
        		$url = url($value['module'].'/'.$value['controller'].'/'.$value['function']);
        	} else {
                $url = url($value['module'].'/'.$value['controller'].'/'.$value['function'].','.$value['parameter']);
        	}
        	$menu[$key]['url'] = $url;
        }
        $menus = $this->menulist($menu);
        $this->assign('menus',$menus);

        return $this->fetch('index');
    }

    protected function menulist($menu){
		$menus = array();
		//先找出顶级菜单
		foreach ($menu as $k => $val) {
			if($val['pid'] == 0) {
				$menus[$k] = $val;
			}
		}
		//通过顶级菜单找到下属的子菜单
		foreach ($menus as $k => $val) {
			foreach ($menu as $key => $value) {
				if($value['pid'] == $val['id']) {
					$menus[$k]['list'][] = $value;
				}
			}
		}
		return $menus;
	}
}
