<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function index(){
		$this->display();
	}
	public function showcode(){
		$verify = new \Think\Verify();
		$verify->length = 4;//设置字符的个数
		$verify->fontSize = 13;//设置字符的大小
		$verify->imageH=  30;               // 验证码图片高度
		$verify->imageW=  80;               // 验证码图片宽度
		$verify->useCurve= false;
		$Verify->useImgBg = false;
		$Verify->useNoise = false;
		$Verify->fontttf = '3.ttf';
		$verify->entry();//显示验证码
	}
	public function checkLogin(){
		$userName = $_POST["username"];
		$password = $_POST["password"];
		$checkCode = $_POST["checkCode"];
		$verify = new \Think\Verify();
		$result=$verify->check($checkCode);
		if($result){
			$result = M("user")->where("username='{$userName}' && userpwd='{$password}'")->select();

			if($result==true)
			{
				$re = M("user")->where("username='{$userName}' && userpwd='{$password}'")->find();
				$_SESSION['user']=$re;
				$this->redirect("Index/index");
			}
			else
			{
				$this->success("登录失败！",__APP__."/Login/index.html");
			}
		}else {
			$this->success("验证码错误！",__APP__."/Login/index.html");
		}

	}
}
