<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/12/15
 * Time: 10:39
 */
namespace Admin\Controller;
use Think\Controller;
class MessageController extends Controller{
    public function index(){
        if($_SESSION['manager']) {
            $re = M("message")->select();
            $this->assign('message', $re);
            $this->display();
        }else{
            $this->success('还未登录',__APP__.'/Index/index',3);
        }
    }

    public function send(){
        $this->assign();
        $this->display();
    }

    public function delete($id){
        M("message")->where("id=$id")->delete();
        $this->redirect("Message/index");
    }

    public function add(){
        M("message")->add($_POST);
        $this->redirect("Message/index");
    }
}