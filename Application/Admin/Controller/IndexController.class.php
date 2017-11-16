<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
       $computer = D('computer')->select();
		$this->assign('computer', $computer);
		
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
        
    }
    
        public function delete() {
		$model = M('computer');
		$where = array(
				'id' => I('get.id'),
		);
		$res = $model->where($where)->delete();
		if ($res === false) {
			$this->error('删除失败，正在返回，请稍后！');
			return;
		}elseif ($res === 0) {
			$this->error('要删除的电脑信息不存在，请重新选择！');
			return;
		}
		$this->success('删除成功，正在跳转，请稍后！',U("index"));
		return;
	}
	
	public function changestates() {
	    $model = M('computer');
	    $where = array(
	        'id' => I('get.id'),
	        'states' => '已处理',
	    );

        if( $model->where($where)->create()  ){
            $this->success('更改状态成功，正在返回首页',U("index"));
        }else{
            $this->error('更改状态失败',U("index"));
        }
	}
	
	
	public function update() {
	    $model = M('computer');
	    $where = array(
	        'id' => I('get.id'),
	    );
	    if (IS_POST) {
	        $computer = $model->create();
	        if ($model->save() !==false) {
	            $this->success('电脑信息更新成功，正在跳转，请稍候！',
	                U("index"));
	            return;
	        }
	        $this->error('电脑信息更新失败，请重新输入！');
	        return;
	    }
	    $computer = $model->where($where)->find();
	    if(!isset($computer)){
	        $this->error('查询的电脑信息不存在，请重新选择！');
	        return;
	    }
	     D('computer')->select();
	   
	    $this->assign('computer',$computer);
	    $this->display();
	}
	
	
}