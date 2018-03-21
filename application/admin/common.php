<?php
//admin模块公共函数
/**
 * 管理员密码加密方式
 * @param $password  密码
 * @param $password_code 密码额外加密字符
 * @return string
 */
function password($password, $password_code='lshi4AsSUrUOwWV'){
    return md5(md5($password) . md5($password_code));
}

/**
 * 管理员操作日志
 * @param  [type] $data [description]
 * @return [type]       [description]
 */
function addlog($operation_id=''){
    //获取网站配置
    $web_config = \think\Db::name('webconfig')->where('web','web')->find();
    if($web_config['is_log'] == 1) {
        $data['operation_id'] = $operation_id;
        $data['admin_id'] = \think\Session::get('admin');//管理员id
        $request = \think\Request::instance();
        $data['ip'] = $request->ip();//操作ip
        $data['create_time'] = time();//操作时间
        $url['module'] = $request->module();
        $url['controller'] = $request->controller();
        $url['function'] = $request->action();
        //获取url参数
        $parameter = $request->path() ? $request->path() : null;
        //将字符串转化为数组
        $parameter = explode('/',$parameter);
        //剔除url中的模块、控制器和方法
        foreach ($parameter as $key => $value) {
            if($value != $url['module'] and $value != $url['controller'] and $value != $url['function']) {
                $param[] = $value;
            }
        }

        if(isset($param) and !empty($param)){
            //确定有参数
            $string = '';
            foreach($param as $key => $value){
                //奇数为参数的参数名，偶数为参数的值
                if($key%2 !== 0){
                    //过滤只有一个参数和最后一个参数的情况
                    if(count($param) > 2 and $key < count($param)-1) {
                        $string.=$value.'&';
                    }else{
                        $string.=$value;
                    }
                }else{
                    $string.=$value.'=';
                }
            } 
        }else{
            //这里有个bug，ajax请求方式，传递的参数path()接收不到，所以只能param()
            $string = [];
            $param = $request->param();
            foreach ($param as $key => $value){
                if(!is_array($value)){
                    //这里不完美，param()会接收到页面表单的数据，数据里有字段的值是数组，所以会出错，这里过滤掉值为数组的参数
                    $string[] = $key.'='.$value;
                }
            }
            $string = implode('&',$string);
        }
        $data['admin_menu_id'] = empty(\think\Db::name('admin_menu')->where($url)->where('parameter',$string)->value('id')) ? \think\Db::name('admin_menu')->where($url)->value('id') : \think\Db::name('admin_menu')->where($url)->where('parameter',$string)->value('id');
                    
        //return $data;
        \think\Db::name('admin_log')->insert($data);
    }else{
        //关闭了日志
        return true;
    }
}


/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '') {
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
    return round($size, 2) . $delimiter . $units[$i];
}

function info($msg = '', $code = '', $url = '',  $data = '', $wait = 3){
	if(is_numeric($msg)){
        $code = $msg;
        $msg  = '';
    }
    if(is_null($url) && isset($_SERVER["HTTP_REFERER"])){
        $url = $_SERVER["HTTP_REFERER"];
    } elseif ('' !== $url) {
        $url = preg_match('/^(https?:|\/)/', $url) ? $url : Url::build($url);
    }
	$result = [
        'code' => $code,
        'msg'  => $msg,
        'data' => $data,
        'url'  => $url,
        'wait' => $wait,
	];
	return $result;
}

//定义返回数据类型,主要满足layui-table要求格式,code=0成功,code=-1失败
function fmtData($data='', $msg='', $code=0){
    //计算$data行数,paginate知道总数
    $count = array_key_exists('total',$data)?$data['total']:count($data);
    $res = array_key_exists('data',$data)?$data['data']:$data;
	if(is_numeric($msg)){
        $code = $msg;
        $msg  = '';
    }
    $result = [
        'code' => $code,
        'msg' => $msg,
        'count' => $count,
        'data' => $res
    ];
    return $result;
}