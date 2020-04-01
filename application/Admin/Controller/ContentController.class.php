<?php
namespace Admin\Controller;
use Think\Controller;
class ContentController extends Controller{
    public function index(){
        if($_SESSION['manager']) {
            $this->display();
        }else{
            $this->success('还未登录',__APP__.'/Index/index',3);
        }
    }
}