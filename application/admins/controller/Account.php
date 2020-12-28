<?php
namespace app\admins\controller;
use think\facade\Session;
use think\facade\View;
use think\db;

class Account
{
    public function login(){
        return View::fetch();
    }
    public function dologin(){

        $username = trim(input('post.username'));
        $password = trim(input('post.password'));
        if($username == ''){
            exit(json_encode(array('code'=>1,'msg'=>'用户名为空')));
        }
        if($password == ''){
            exit(json_encode(array('code'=>1,'msg'=>'密码为空')));
        }
        $res = Db::table('admin')->where('username',$username)->find();
        if(empty($res)){
            exit(json_encode(array('code'=>1,'msg'=>'用户名/密码不正确')));
        }
        if($res['password'] != md5($password)){
//            dump(md5($password));
            exit(json_encode(array('code'=>1,'msg'=>'用户名/密码不正确')));
        }
        Session::set('username',$username);
        Session::set('password',$password);
        exit(json_encode(array('code'=>'12346','msg'=>'登录成功')));

    }
    public function logout(){
        Session::set('username',null);
        Session::set('password',null);
        $this->redirect('login');
        exit();
    }
}
