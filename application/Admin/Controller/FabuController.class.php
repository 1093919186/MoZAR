<?php
namespace Admin\Controller;
use Think\Controller;
class FabuController extends Controller{
    public function index($id){
        if($_SESSION['manager']) {
            $rs = M('product')->where("daishouid = {$id}")->find();
            if ($rs > 0) {
                $this->success('该产品已发布', __APP__ . '/daishou/index', 3);
                exit;
            }
            $arr = M('daishou')->find($id);
            $truename = M('user')->field('truename')->find($arr['userid']);
            $this->assign('truename', $truename['truename']);
            $this->assign('arr', $arr);
            $this->assign('id', $id);
            $this->display();
        }else{
            $this->success('还未登录',__APP__.'/Index/index',3);
        }
    }
    public function save($id){
        // alter table product add daishouid  int unsigned  not null unique ;
        $_POST['brandid']   = substr($_POST['brandid'],-2);
        $_POST['pinpid']    = $_POST['brandid'];
        $_POST['daishouid'] = $id;
        unset($_POST['brandid']);

        $rs = M('product')->add($_POST);
        if($rs>0){
            $arr = array('state'=>'正在销售');
            M('daishou')->where("id = {$id}")->save($arr);
            $arr = M('dspic')->field('picpath')->where("id  = {$id} ")->select();
            foreach($arr as $k=>$v){
                $filename  = 'public/picture/dspic/'.$v['picpath'];
                $filename1 = 'public/picture/big/'.$v['picpath'];
                $filename2 = 'public/picture/mid/'.$v['picpath'];
                $filename3 = 'public/picture/small/'.$v['picpath'];
                copy($filename,$filename1);
                copy($filename,$filename2);
                copy($filename,$filename3);
                $arr = array('imagepath'=>$filename3,'productid'=>$rs,'bj'=>0);
                M('productimage')->add($arr);
            }
            $arr3 = M('productimage')->where("  productid  = {$rs} ")->find();
            $arr5['imagepath'] = str_replace('small','mid', $arr3['imagepath']);
            $arr5['bj'] = 1;
            $arr5['productid']=$rs;
            M('productimage')->add($arr5);
            $arr4 = array('bj' => 1);
            M('productimage')->where(" picid = {$arr3['picid']} ")->save($arr4);
            $this->success('发布成功',__APP__.'/daishou/index',3);
        }else{
            $this->success('发布失败',__APP__.'/Fabu/index/id/'.$id,3);
        }
    }
}