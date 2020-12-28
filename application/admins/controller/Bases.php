<?php
namespace app\admins\controller;
use think\db;
use think\facade\Session;
use think\facade\View;

class Bases extends \think\Controller
{
    // 权限校验
    public function initialize(){
        $username = Session::get('username');
        $password = Session::get('password');
        // 是否已经登录(已登录：放行；未登录：跳到登录页面)
        if(!$username){
            header('Location: /index.php/admins/account/login');
            exit;
        }
        if(!$password){
            header('Location: /index.php/admins/account/login');
            exit;
        }
        // 判断用户是否是正常用户
        $islogin = Db::table('admin')->where(array('username'=>$username,'password'=>md5($password)))->find();
        if(!$islogin){
            header('Location: /index.php/admins/account/login');
            exit;
        }

    }

}