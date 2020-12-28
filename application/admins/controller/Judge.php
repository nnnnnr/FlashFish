<?php

namespace app\admins\controller;
use think\db;
use think\facade\Request;
use think\Controller;
use think\facade\View;
use think\facade\Session;
use think\Validate;

class Judge extends Bases
{
    public function index(){

        $key['modules'] = trim(input('get.modules'));
        $key['vkeyvalue'] = trim(input('get.keyvalue'));
        $key['keyvalue'] = '%'.$key['vkeyvalue'].'%';
        if($key['modules']&&$key['keyvalue']){
            if($key['modules'] == 'ip'){
                $visits = Db::table('judge')->order('fish_jointime', 'desc')->where('fish_ip','like',$key['keyvalue'])
                    ->paginate(5,false,['query' => request()->param()]);
            }else if($key['modules'] == 'browser'){
                $visits = Db::table('judge')->order('fish_jointime', 'desc')->where('fish_browser','like',$key['keyvalue'])
                    ->paginate(5,false,['query' => request()->param()]);
            }else if($key['modules'] == 'os'){
                $visits = Db::table('judge')->order('fish_jointime', 'desc')->where('fish_os','like',$key['keyvalue'])
                    ->paginate(5,false,['query' => request()->param()]);
            }else{
                $visits = Db::table('judge')->order('fish_jointime', 'desc')->where('fish_requesttype','like',$key['keyvalue'])
                    ->paginate(5,false,['query' => request()->param()]);
            }
        }else{
            $visits = Db::table('judge')->order('fish_jointime', 'desc')
                ->Distinct('fish_ip')->paginate(5,false,['query' => request()->param()]);
        }
        $this->assign([
            'modules'=>$key['modules'],
            'vkeyvalue'=>$key['vkeyvalue']
        ]);
        $this->view->visits=$visits;
        return View::fetch();
    }

    public function delete(){
        $data = $_POST;
        $validate = new Validate([
            '__token__'=>'require|token',
        ]);
        if(!$validate->check($data)){
            exit(json_encode(array('code'=>0,'msg'=>'Token验证失败!')));
        }

        $fish_ip = trim(input('post.ip'));
        Db::table('jutime')->where('ip',$fish_ip)->delete();
        $res = Db::table('judge')->where('fish_ip',$fish_ip)->delete();
        if(!$res){
            exit(json_encode(array('code'=>1,'msg'=>'删除失败!')));
        }
        exit(json_encode(array('code'=>0,'msg'=>'删除成功!')));
    }
    public function gettime(){
        $fish_ip = input('get.fish_ip');
        $gettimes = Db::table('jutime')->where('ip',$fish_ip)
            ->order('requesttime', 'desc')->paginate(8,false,['query'=>request()->param()]);
        $this->view->jutimes=$gettimes;
        return View::fetch();
    }
    public function deletetime(){
        $data = $_POST;
        $validate = new Validate([
            '__token__'=>'require|token',
        ]);
        if(!$validate->check($data)){
            exit(json_encode(array('code'=>0,'msg'=>'Token验证失败!')));
        }
        $id = (int)input('post.id');
        $res = Db::table('jutime')->where('id',$id)->delete();
        if(!$res){
            exit(json_encode(array('code'=>1,'msg'=>'删除失败!')));
        }
        exit(json_encode(array('code'=>0,'msg'=>'删除成功!')));
    }
}
