<?php
namespace Admin\Controller;
use Think\Controller;
class SearchController extends Controller{
    public function wsh(){
        if($_SESSION['manager']) {
            $User = M('daishou'); // 实例化User对象
            // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
            $list = $User->field('daishou.*,place.province,place.placename')->join("place on place.id = daishou.placeid")->where("placeid = '{$_SESSION['manager']['placeid']}' and state='未收货'")->page($_GET['p'].',10')->limit(10)->select();
            $this->assign('list',$list);// 赋值数据集
            $count      = $User->field('daishou.*,place.province,place.placename')->join("place on place.id = daishou.placeid")->where("placeid = '{$_SESSION['manager']['placeid']}' and state='未收货' ")->count();// 查询满足要求的总记录数
            $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
            $show       = $Page->show();// 分页显示输出
            $this->assign('arr',$list);
            $this->assign('page',$show);// 赋值分页输出
            $this->display(); // 输出模板
        }else{
            $this->success('还未登录',__APP__.'/Index/index',3);
        }
    }
    public function ysh(){
        if($_SESSION['manager']) {
            $User = M('daishou'); // 实例化User对象
            // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
            $list = $User->field('daishou.*,place.province,place.placename')->join("place on place.id = daishou.placeid")->where("placeid = '{$_SESSION['manager']['placeid']}' and state='已收货'")->page($_GET['p'].',10')->limit(10)->select();
            $this->assign('list',$list);// 赋值数据集
            $count      = $User->field('daishou.*,place.province,place.placename')->join("place on place.id = daishou.placeid")->where("placeid = '{$_SESSION['manager']['placeid']}' and state='已收货' ")->count();// 查询满足要求的总记录数
            $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
            $show       = $Page->show();// 分页显示输出
            $this->assign('arr',$list);
            $this->assign('page',$show);// 赋值分页输出
            $this->display(); // 输出模板
        }else{
            $this->success('还未登录',__APP__.'/Index/index',3);
        }
    }
    public function zzxs(){
        if($_SESSION['manager']) {
            $User = M('daishou'); // 实例化User对象
            // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
            $list = $User->field('daishou.*,place.province,place.placename')->join("place on place.id = daishou.placeid")->where("placeid = '{$_SESSION['manager']['placeid']}' and state='正在销售'")->page($_GET['p'].',10')->limit(10)->select();
            $this->assign('list',$list);// 赋值数据集
            $count      = $User->field('daishou.*,place.province,place.placename')->join("place on place.id = daishou.placeid")->where("placeid = '{$_SESSION['manager']['placeid']}' and state='正在销售' ")->count();// 查询满足要求的总记录数
            $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
            $show       = $Page->show();// 分页显示输出
            $this->assign('arr',$list);
            $this->assign('page',$show);// 赋值分页输出
            $this->display(); // 输出模板
        }else{
            $this->success('还未登录',__APP__.'/Index/index',3);
        }
    }
    public function ysc(){
        if($_SESSION['manager']) {
            $User = M('daishou'); // 实例化User对象
            // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
            $list = $User->field('daishou.*,place.province,place.placename')->join("place on place.id = daishou.placeid")->where("placeid = '{$_SESSION['manager']['placeid']}' and state='已售出'")->page($_GET['p'].',10')->limit(10)->select();
            $this->assign('list',$list);// 赋值数据集
            $count      = $User->field('daishou.*,place.province,place.placename')->join("place on place.id = daishou.placeid")->where("placeid = '{$_SESSION['manager']['placeid']}' and state='已售出' ")->count();// 查询满足要求的总记录数
            $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
            $show       = $Page->show();// 分页显示输出
            $this->assign('arr',$list);
            $this->assign('page',$show);// 赋值分页输出
            $this->display(); // 输出模板
        }else{
            $this->success('还未登录',__APP__.'/Index/index',3);
        }
    }
}