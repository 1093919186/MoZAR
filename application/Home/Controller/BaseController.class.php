<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/11/28
 * Time: 9:36
 */
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function _initialize(){
        $brand=M("brand")->select();
        $tree = getSubTree($brand,0,0);
        $truename=$_SESSION['user']['truename'];
        $this->assign("truename",$truename);
        $this->assign("brand",$tree);
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