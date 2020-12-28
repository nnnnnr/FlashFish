<?php

namespace app\admins\controller;
use think\db;
use think\facade\Request;

class Index
{
    public function index()
    {
        date_default_timezone_set('prc');
        //下面为该接口请求地址  js文件中与下面保持一致即可
        // http://127.0.0.1/fishlog/public/index.php/admins/Index/index
        // ip
        $ip = request()->ip();
        // 请求方式 requesttype
        $requesttype = request()->method();
        // 获取用户代理基本信息
        $flag = $_SERVER['HTTP_USER_AGENT'];
        // 定义一个空数组
        $para = array();
        // 检查操作系统
        if (preg_match('/Windows[\d\. \w]*/', $flag, $match)) {
            $para['os'] = $match[0];
        }
        if (preg_match('/Chrome\/[\d\.\w]*/', $flag, $match)) {
            // 检查Chrome
            $para['browser'] = $match[0];
        } elseif (preg_match('/Safari\/[\d\.\w]*/', $flag, $match)) {
            // 检查Safari
            $para['browser'] = $match[0];
        } elseif (preg_match('/MSIE [\d\.\w]*/', $flag, $match)) {
            // IE
            $para['browser'] = $match[0];
        } elseif (preg_match('/Opera\/[\d\.\w]*/', $flag, $match)) {
            // opera
            $para['browser'] = $match[0];
        } elseif (preg_match('/Firefox\/[\d\.\w]*/', $flag, $match)) {
            // Firefox
            $para['browser'] = $match[0];
        } elseif (preg_match('/OmniWeb\/(v*)([^\s|;]+)/i', $flag, $match)) {
            //OmniWeb
            $para['browser'] = $match[2];
        } elseif (preg_match('/Netscape([\d]*)\/([^\s]+)/i', $flag, $match)) {
            //Netscape
            $para['browser'] = $match[2];
        } elseif (preg_match('/Lynx\/([^\s]+)/i', $flag, $match)) {
            //Lynx
            $para['browser'] = $match[1];
        } elseif (preg_match('/360SE/i', $flag, $match)) {
            //360SE
            $para['browser'] = '360安全浏览器';
        } elseif (preg_match('/SE 2.x/i', $flag, $match)) {
            //搜狗
            $para['browser'] = '搜狗浏览器';
        } else {
            $para['browser'] = 'unkown';
        }
        // ua
        $ua = $flag;
        // os  操纵系统
        $os =  $para['os'];
        // browser 浏览器
        $browser =  $para['browser'];
        // referer 来源
        // $referer  = $_SERVER['HTTP_REFERER'];
        // var_dump($referer);
        // 时间
        $jointime = time();
        $action = '进入渔场';
        $data = ['fish_ip'=>$ip,'fish_browser'=>$browser,'fish_os'=>$os,'fish_ua'=>$ua,'fish_jointime'=>$jointime,'fish_action'=>$action,'fish_requesttype'=>$requesttype,'visit_number'=>1];
        $jutime_data = ['ip'=>$ip,'requesttime'=>$jointime,'biao'=>'judge'];
        Db::table('jutime')->data($jutime_data)->insert();
        $isrepeat = Db::name('judge')->where('fish_ip',$ip)->find();
        if($isrepeat){
            Db::table('judge')->where('fish_ip',$ip)->setInc('visit_number');
        }else {
            Db::table('judge')->data($data)->insert();
        }
        $res = Db::table('gethook')->where('fish_ip',$ip)->find();
        if($res){
            $isExistHook = 'fishishooked';
        }else{
            $isExistHook = 'fishisnothooked';
        }
//        return 'fail';
        return $isExistHook;
    }

    // http://127.0.0.1/fishlog/public/index.php/admins/Index/onhook
    public function onhook()
    {
        date_default_timezone_set('prc');
        // ip
        $ip = request()->ip();
        // 时间
        $hooktime = time();
        $hook_data = ['fish_ip'=>$ip,'fish_hooktime'=>$hooktime,'fish_action'=>'上钩'];
        Db::table('gethook')->data($hook_data)->insert();
    }
}
