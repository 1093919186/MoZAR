<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
        $re=M('indexpic')->where('sort=1 and size=1')->find();
        $manbig=$re;
        $mansmall=M('indexpic')->where('sort=1 and size=2')->select();
        $girl=M('indexpic')->where('sort=2')->select();
        $bigbag=M('indexpic')->where('sort=3 and size=1')->find();
        $smallbag=M('indexpic')->where('sort=3 and size=2')->find();
        $shoes=M('indexpic')->where('sort=4 and size=1')->select();
        $lunbo=M('lunbo')->select();

        $this->assign('lunbo',$lunbo);
        $this->assign('shoes',$shoes);
        $this->assign('smallbag',$smallbag);
        $this->assign('bigbag',$bigbag);
        $this->assign('girl',$girl);
        $this->assign('mansmall',$mansmall);
        $this->assign('manbig',$manbig);
    	$this->display();
    }

}