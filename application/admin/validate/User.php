<?php
namespace app\admin\validate;

use think\Validate;

class User extends Validate{
    //验证规则
    protected $rule = [
        '__token__'     => 'token',
        'name'          => 'require|alphaDash',
        'nickname'      => 'require',
        'admin_cate_id' => 'require|number',
        'password'      => 'require', 
        'password_confirm'=>'require|confirm:password'
    ];
    //验证错误信息
    protected $message = [
        'name.require'             => '管理员名称不能为空',
        'name.alphaDash'           => '用户名格式只能是字母、数组、——或_',
        'admin_cate_id.require'    => '请选择管理员分组',
        'password.require'         => '密码不能为空',
        'password_confirm.require' => '重复密码不能为空',
        'password_confirm.confirm' => '两次密码不一致',
    ];
    //验证场景
    protected $scene = [
        'add' => ['name','nickname','password','admin_cate_id'],
        'edit' => ['name','nickname','admin_cate_id'],
        'editpassword' => ['password','password_confirm'],
    ];

}


