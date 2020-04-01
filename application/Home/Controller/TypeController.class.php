<?php
namespace Home\Controller;
use Think\Controller;
class TypeController extends BaseController {
	public function index($typeid){
		$re=M('product')->where("pinpid=$typeid")->select();
		foreach($re as $k=>$v){
			$productid=$v['id'];
			$image=M('productimage')->where("productid=$productid")->find();
			$image=$image['imagepath'];
			$re[$k]['image']=$image;
		}


        $this->assign('re',$re);
		$this->display();
	}
}