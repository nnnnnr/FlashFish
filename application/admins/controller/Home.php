<?php

namespace app\admins\controller;
use think\db;
use think\facade\Request;
use think\Controller;
use think\facade\View;
use think\facade\Session;

class Home extends Bases
{
    public function index(){
        $username = Session::get('username');
        $notice = 0;
        $res = Db::table('gethook')->where('isread',0)->select();
        if($res){
            $notice = 1;
        }
        $this->assign('notice',$notice);
        $this->assign('username',$username);
//        $this->assign([
//            'modules'=>$key['modules'],
//            'vkeyvalue'=>$key['vkeyvalue']
//        ]);
        return View::fetch();
    }
    public function welcome(){
        return View::fetch();
    }
    public function ceshi(){
        var_dump($_SERVER['DOCUMENT_ROOT']);
    }

}
