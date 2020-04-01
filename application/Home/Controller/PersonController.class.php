<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/12/13
 * Time: 17:18
 */

namespace Home\Controller;
use Think\Controller;
class PersonController extends BaseController {
    public function index(){
        $userid=$_SESSION['user']['id'];
        $user=M('user')->where("id=$userid")->find();
        $id=$user['id'];
        $userinfo=M("user")->where("id=$id")->find();
        $message=M("message")->select();
        $daishou=M("daishou")->join('inner join place on place.id=daishou.placeid')->where("userid=$id")->select();
        $orders=M("orders")->join('inner join place on place.id=orders.placeid')->where("orders.userid=$id")->select();
        foreach($orders as $k=>$v){
            $productid=$v['productid'];
            $name=M("product")->where("id=$productid")->find();
            $name=$name['name'];
            $orders[$k]['name']=$name;
        }

        $this->assign('orders',$orders);
        $this->assign('daishou',$daishou);
        $this->assign('message',$message);
        $this->assign('userinfo',$userinfo);
        $this->display();
    }

    public function ajax($id){
        $re=M("user")->where("id=$id")->save($_POST);
        if($re){

            $_SESSION['user']['truename']=$_POST['truename'];
            $this->redirect("Person/index");

        }
    }
}