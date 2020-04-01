<?php
namespace Home\Controller;
use Think\Controller;
class SearchController extends BaseController {
	public function index(){
        $search=$_POST['search'];
		$re=M("product")->where("name like '%$search%'")->select();
		foreach($re as $k=>$v){
			$id=$v['id'];
			$img=M("productimage")->where("productid=$id")->find();
			$re[$k]['img']=$img;
		}

		$this->assign('re',$re);
		$this->display();
	}
}
