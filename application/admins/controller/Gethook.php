<?php

namespace app\admins\controller;
use think\db;
use think\facade\Request;
use think\Controller;
use think\facade\View;
use think\facade\Session;
use think\Validate;

class Gethook extends Bases
{
    public function index(){
        $fishhooks = Db::table('gethook')->order('id','desc')->paginate(9);
        $this->view->fishhooks=$fishhooks;
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

        $id = (int)input('post.id');
        $res = Db::table('gethook')->where('id',$id)->delete();
        if(!$res){
            exit(json_encode(array('code'=>1,'msg'=>'删除失败!')));
        }
        exit(json_encode(array('code'=>0,'msg'=>'删除成功!')));
    }
    public function readed(){
        $id = (int)input('post.id');
        $res = Db::name('gethook')->where('id',$id)
            ->data('isread',1)->update();
        if(!$res){
            exit(json_encode(array('code'=>1,'msg'=>'更新失败!')));
        }
        exit(json_encode(array('code'=>0,'msg'=>'更新成功!')));
    }
}
