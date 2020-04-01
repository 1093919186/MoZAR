<?php
namespace Admin\Controller;
use Think\Controller;

class IndexpicController extends Controller{
    public function index(){
        if($_SESSION['manager']) {
            $rs1 = M('indexpic')->join('brand on indexpic.pinpid = brand.id')->where(' sort = 1')->select();
            $this->assign('rs1', $rs1);
            $rs2 = M('indexpic')->join('brand on indexpic.pinpid = brand.id')->where(' sort = 2')->select();
            $this->assign('rs2', $rs2);
            $rs3 = M('indexpic')->join('brand on indexpic.pinpid = brand.id')->where(' sort = 3')->select();
            $this->assign('rs3', $rs3);
            $rs4 = M('indexpic')->join('brand on indexpic.pinpid = brand.id')->where(' sort = 4')->select();
            $this->assign('rs4', $rs4);
            $this->display();
        }else{
            $this->success('还未登录',__APP__.'/Index/index',3);
        }
    }
    public function modify($picid){
        $rs1 = M('indexpic')->find($picid);
        $this->assign('rs',$rs1);
        
        $this->display(modify);
    }
    public function save($picid){
        $rs = M('indexpic')->find($picid);
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './public/picture/index/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $upload->autoSub   =      false;
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            unlink($rs['picpath']);
            rename('./public/picture/index/'.$info['pic']['savename'],$rs['picpath']);
            $this->success('上传成功！',__APP__.'/indexpic/index',3);
        }
    }
    public function lunbo(){
        $rs = M('lunbo')->select();
        $this->assign('rs',$rs);
        $this->display();
    }
    public function lunbomodify($picid){
        $rs  = M('lunbo')->find($picid);
        $this->assign('rs',$rs);
        $this->display();
    }
    public function lunbosave($picid){
        $rs1 = M('lunbo')->find($picid);
        $path1 = substr($rs1['picpath'],1);
        unlink($rs1['picpath']);
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './public/picture/lunbo/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $upload->autoSub   =      false;
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            
        }
        $_POST['picpath'] = '/public/picture/lunbo/'.$info['pic']['savename'];
        $rs = M('lunbo')->where("picid = {$picid} ")->save($_POST);
        if($rs>0){
            unlink($path1);
            $this->success('修改成功',__APP__.'/indexpic/lunbo',3);
        }else{
            $this->success('修改失败',__APP__.'/'.'indexpic/lunbomodify/picid/'.$picid,3);
        }
    }
}
?>