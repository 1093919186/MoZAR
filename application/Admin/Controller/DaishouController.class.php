<?php
namespace Admin\Controller;
use Think\Controller;
class DaishouController extends Controller{
    public function index(){
        if($_SESSION['manager']) {
            $User = M('daishou'); // 实例化User对象
            // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
            $list = $User->field('daishou.*,place.province,place.placename')->join("place on place.id = daishou.placeid")->where("placeid = '{$_SESSION['manager']['placeid']}'")->page($_GET['p'].',10')->limit(10)->select();
            $this->assign('list',$list);// 赋值数据集
            $count      = $User->field('daishou.*,place.province,place.placename')->join("place on place.id = daishou.placeid")->where("placeid = '{$_SESSION['manager']['placeid']}'")->count();// 查询满足要求的总记录数
            $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
            $show       = $Page->show();// 分页显示输出
            $this->assign('arr',$list);
            $this->assign('page',$show);// 赋值分页输出
            $this->display(); // 输出模板
        }else{
            $this->success('还未登录',__APP__.'/Index/index',3);
        }
    }
    public function make($id){
        $arr = array('id'=>$id,'state'=>'已收货');
        $rs = M('daishou')->save($arr);
        if($rs>0){
            echo '操作成功';
        }else{
            echo '操作失败';
        }
    }
    public function cancel($id){
        $arr = array('id'=>$id,'state'=>'未收货');
        $rs = M('daishou')->save($arr);
        if($rs>0){
            echo '操作成功';
        }else{
            echo '操作失败';
        }
    }
    public function del($id){
        $if = M('daishou')->find($id);
        if($if['state'] == '已收货' || $if['state'] ==  '未收货' ){
            $rs1 = M('daishou')->delete($id);
            $arr = M('dspic')->field('picpath')->where(" id = {$id}")->select();
            foreach($arr as $k=>$v){
                unlink('./public/picture/dspic/'.$v['picpath']);      /*./是因为入口文件是index.php*/
            }
            $rs2 =M('dspic')->where(" id = {$id}")->delete();
            if($rs1>0 && $rs2 >0){
                echo '操作成功';
            }else{
                echo '操作失败';
            }
        }else if($if['state']=='正在销售'){
            // 删除daihsou dspic 和 图片
            $rs1 = M('daishou')->delete($id);
            $arr = M('dspic')->field('picpath')->where(" id = {$id}")->select();
            foreach($arr as $k=>$v){
                unlink('./public/picture/dspic/'.$v['picpath']);
            }
            $rs2 =M('dspic')->where(" id = {$id}")->delete();
            
            // 删除product productimage 和图片
            $arr  = M('product')->field('id')->where("daishouid = {$id} ")->find();
            $productid = $arr['id'];
            $arr  = M('productimage')->where("productid= {$productid}")->limit(6)->select();
            foreach($arr as $k =>$v){
                $filename = $v['imagepath'];
                $filename = substr($filename,strrpos($filename,'/')+1);
                $url1 = './public/picture/big/'.$filename;
                $url2 = './public/picture/small/'.$filename;
                $url3 = './public/picture/mid/'.$filename;
                unlink($url1);
                unlink($url2);
                unlink($url3);
            }
            $rs3 = M('productimage')->where("productid= {$productid}")->delete();
            $rs4 = M('product')->where("daishouid = {$id} ")->delete();
            if($rs1>0 && $rs2>0 && $rs3 >0 && $rs4 >0 ){
                echo '操作成功';
            }else{
                echo '操作失败';
            }
        }else{
            $rs1 = M('daishou')->delete($id);
            $arr = M('dspic')->field('picpath')->where(" id = {$id}")->select();
            foreach($arr as $k=>$v){
                unlink('./public/picture/dspic/'.$v['picpath']);
            }
            $rs2 =M('dspic')->where(" id = {$id}")->delete();
            
            // 删除product productimage 和图片
            $arr  = M('product')->field('id')->where("daishouid = {$id} ")->find();
            $productid = $arr['id'];
            $arr  = M('productimage')->where("productid= {$productid}")->limit(6)->select();
            foreach($arr as $k =>$v){
                $filename = $v['imagepath'];
                $filename = substr($filename,strrpos($filename,'/')+1);
                $url1 = './public/picture/big/'.$filename;
                $url2 = './public/picture/small/'.$filename;
                $url3 = './public/picture/mid/'.$filename;
                unlink($url1);
                unlink($url2);
                unlink($url3);
            }
            $rs3 = M('productimage')->where("productid= {$productid}")->delete();
            $rs4 = M('product')->where("daishouid = {$id} ")->delete();
            
            $rs5 =M('orders')->where(" daishouid = {$id} ")->delete();
            if($rs1>0 && $rs2>0 && $rs3 >0 && $rs4 >0 && $rs5>0 ){
                echo '操作成功';
            }else{
                echo '操作失败';
            }
        }
    }
    public function send($id){
        $arr  = array('state'=>'已发货');
        $rs = M('orders')->where("daishouid = {$id} ")->save($arr);
        $this->success("发货成功",__APP__."/Daishou/index",3);
    }
}