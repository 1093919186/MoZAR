<?php
namespace Home\Controller;
use Think\Controller;
class RegisterController extends Controller {
	public function index(){
		$this->display();
	}
	public function insert(){
		$checkCode = $_POST["checkCode"];
		$verify = new \Think\Verify();
		$result=$verify->check($checkCode);

		if($result){
			$result = M("user")->data($_POST)->add();
			if($result > 0){
				$_SESSION['user']=$_POST;
				$_SESSION['user']['truename']='未填写';
				$_SESSION['user']['id']=$result;
				$this->redirect("Index/index");

			}else{
				$this->success("注册失败！",__APP__."/Register/index.html");
			}
		}else{
			$this->success("验证码错误！",__APP__."/Register/index.html");
		}
	}
}
