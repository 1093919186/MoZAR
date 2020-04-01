<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/12/13
 * Time: 17:19
 */
namespace Home\Controller;
use Think\Controller;
class FabuController extends Controller {
    public function index($flag=0){
        if($_SESSION['user']) {
            if ($flag == 0) {
                $place = M('place')->select();
                $user = $_SESSION['user'];
                $this->assign('place', $place);
                $this->assign('user', $user);

                $brand = M("brand")->select();
                $tree = getSubTree($brand, 0, 0);
                $this->assign("brand", $tree);

                $this->display();
            } else if ($flag == 1) {
                $place = M('place')->select();
                $user = $_SESSION['user'];
                $this->assign('place', $place);
                $this->assign('user', $user);

                $brand = M("brand")->select();
                $tree = getSubTree($brand, 0, 0);
                $this->assign("brand", $tree);

                $this->display();
                echo '<script>
        function show(){
        var div1 = document.getElementById("success");
        div1.style.display="block";
        var b1 = document.getElementById("title");
        b1.innerHTML="发布成功";
        }
        show();
        </script>';
            } else if ($flag == 2) {
                $place = M('place')->select();
                $user = $_SESSION['user'];
                $this->assign('place', $place);
                $this->assign('user', $user);
                $this->display();
                echo '<script>
        function show(){
        var div1 = document.getElementById("success");
        div1.style.display="block";
        var b1 = document.getElementById("title");
        b1.innerHTML="发布失败";
        }
        show();
        </script>';
            }
        }else{
            $this->redirect("Login/index");
        }

    }
    public function add(){
        $rs = M('daishou')->add($_POST);
        if($rs<0){$this->redirect('Fabu/index', array('flag' => 2), 0, '页面跳转中...');}
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './public/picture/dspic/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $upload->autoSub=false;
        // 上传文件
        $info   =   $upload->upload();
        foreach($info as $k=>$v){
            $arr['picpath'] = $v['savename'];
            $arr['id']= $rs;
            $rs2 = M('dspic')->add($arr);
        }
        if($rs>0){
            $this->redirect('Fabu/index', array('flag' => 1), 0, '页面跳转中...');
        }else{
            $this->redirect('Fabu/index', array('flag' => 2), 0, '页面跳转中...');
        }
    }
}

function getSubTree($data , $id = 0 , $lev = 0) {
    static $son = array();

    foreach($data as $key => $value) {
        if($value['pid'] == $id) {
            $value['lev'] = $lev;
            $son[] = $value;
            getSubTree($data , $value['id'] , $lev+1);
        }
    }
    return $son;
}