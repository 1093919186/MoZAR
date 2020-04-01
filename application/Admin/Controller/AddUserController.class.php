<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/12/15
 * Time: 11:41
 */
namespace Admin\Controller;
use Think\Controller;
class AddUserController extends Controller{
    public function index(){
        if($_SESSION['manager']) {
            $place = M("place")->select();
            $this->assign('place', $place);
            $this->display();
        }else{
            $this->success('还未登录',__APP__.'/Index/index',3);
        }
    }

    public function modify(){
        $admin=M("admin")->select();
        $this->assign('admin',$admin);
        $this->display();
    }

    public function add(){
        $place=$_POST['placeid'];
        $place=M("place")->where("placename='$place'")->find();
        $placeid=$place['id'];
        $_POST['placeid']=$placeid;
        $re=M("admin")->add($_POST);
        if($re){
            $this->success('添加成功',__APP__.'/AddUser/modify',3);
        }else {
            $this->success('添加失败', __APP__ . '/AddUser/index', 3);
        }
    }

    public function delete($id){
        $re=M("admin")->where("id=$id")->delete();
        if($re){
            $this->success('删除成功',__APP__.'/AddUser/modify',3);
        }else {
            $this->success('删除失败', __APP__ . '/AddUser/modify', 3);
        }
    }
}