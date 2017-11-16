<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
       $this->display();
    }
    
    public function handle(){
        if(!IS_POST) {
		$this->error('禁止访问');
	}
        $data = array(
            'username' => I('username','','htmlspecialchars'),
            'content' => I('content','','htmlspecialchars'),
            'email' => I('email','','htmlspecialchars'),
        );
        if( M('computer')->data($data)->add() ){
            $this->success('提交成功，正在返回首页','index');
        }else{
            $this->error('提交失败');
        }
        echo $id;
    }
}


